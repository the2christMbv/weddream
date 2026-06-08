<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WedDream | Espace Service & Accueil</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gold-gradient: linear-gradient(135deg, #c5a059 0%, #f1d394 50%, #c5a059 100%);
            --royal-blue: #0a192f;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --luxury-gold: #c5a059;
        }

        body {
            background-color: #fdfbf7;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--royal-blue);
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            height: 380px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--royal-blue);
        }

        .hero-image {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 140%;
            background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=2070');
            background-size: cover;
            background-position: center;
            z-index: 1;
            opacity: 0.6;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(10, 25, 47, 0.8));
            z-index: 2;
        }

        .hero-title {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
        }

        .hero-title h1 {
            font-family: 'Cinzel Decorative', serif;
            font-size: 3rem;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .main-content {
            position: relative;
            z-index: 10;
            margin-top: -80px;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            padding: 2.5rem;
        }

        .btn-gold-luxe {
            background: var(--gold-gradient);
            color: var(--royal-blue);
            border: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-gold-luxe:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.3);
            color: var(--royal-blue);
        }

        .guest-row { transition: all 0.2s; border-bottom: 1px solid #f0f0f0; }
        .guest-row:hover { background-color: rgba(197, 160, 89, 0.05) !important; }

        #reader {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            display: none;
            margin-bottom: 20px;
        }

        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body>

    <div class="hero-section no-print">
        <div class="hero-image" id="parallax"></div>
        <div class="hero-overlay"></div>
        <div class="hero-title">
            <h1 class="animate__animated animate__fadeInDown">WedDream</h1>
            <p class="lead fw-light text-white-50">Espace Service & Accueil | {{ $wedding->title ?? 'Prestige Event' }}</p>
        </div>
    </div>

    <main class="container main-content mb-5">
        
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3 no-print">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-3 no-print">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="row g-3 mb-4 no-print">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold">TOTAL INVITÉS</h6>
                    <h3 class="fw-bold m-0">{{ $guests->sum('access_count') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold text-success">PRÉSENTS (SCAN)</h6>
                    <h3 class="fw-bold m-0">{{ $guests->where('is_checked_in', true)->sum('access_count') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold text-warning">CONFIRMÉS (RSVP)</h6>
                    <h3 class="fw-bold m-0">{{ $guests->where('rsvp_status', 'confirme')->sum('access_count') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold text-info">TABLES DISPONIBLES</h6>
                    <h3 class="fw-bold m-0">{{ $tables->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="row g-3 mb-4 no-print align-items-center justify-content-between">
                <div class="col-md-4">
                    <button class="btn btn-dark w-100 py-3 rounded-4 shadow-sm" id="scannerToggle" onclick="toggleScanner()">
                        <i class="bi bi-qr-code-scan me-2"></i> Scanner Ticket QR
                    </button>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-4 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control py-3 border-start-0 rounded-end-4 shadow-sm" placeholder="Rechercher un invité, une table, une boisson attendue...">
                    </div>
                </div>
            </div>

            <div id="reader" class="no-print shadow-lg bg-light"></div>

            <h5 class="fw-bold mb-4 text-uppercase tracking-wider no-print"><i class="bi bi-grid-3x3-gap-fill text-warning me-2"></i>Plan d'Occupation des Tables</h5>
            
            <div class="row g-3 mb-5 no-print">
                @foreach($tables as $table)
                    @php
                        $allocatedSeats = $table->invitations->sum('access_count');
                        $isFull = $allocatedSeats >= $table->capacity;
                    @endphp
                    <div class="col-xl-3 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 p-3 h-100 {{ $isFull ? 'border-start border-danger border-4' : '' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="fw-bold d-block text-dark">{{ $table->name }}</span>
                                    <small class="text-muted">{{ $allocatedSeats }} / {{ $table->capacity }} installés</small>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 5px;">
                                <div class="progress-bar {{ $isFull ? 'bg-danger' : 'bg-warning' }}" style="width: {{ $table->capacity > 0 ? ($allocatedSeats / $table->capacity) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h5 class="fw-bold mb-3 text-uppercase tracking-wider"><i class="bi bi-people-fill text-warning me-2"></i>Registre de Service des Invités</h5>
            <div class="table-responsive border rounded-4 bg-white shadow-sm">
                <table class="table align-middle mb-0" id="guestsTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Invité & Token</th>
                            <th>Catégorie</th>
                            <th>Places</th>
                            <th>Boisson(s) Choisie(s)</th>
                            <th>Placement Salle</th>
                            <th class="text-center">Pointage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guests as $guest)
                        <tr class="guest-row" id="guest-row-{{ $guest->id }}">
                            <td class="ps-4">
                                <div class="fw-bold guest-name">{{ $guest->guest_name }}</div>
                                <div class="text-muted small">ID Token: {{ $guest->link_token }}</div>
                            </td>
                            
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3">
                                    {{ ucfirst($guest->type) }}
                                </span>
                            </td>
                            
                            <td class="text-muted small fw-bold">
                                {{ $guest->access_count }} pers.
                            </td>
                            
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    @if(!empty($guest->preorder_drink) && (is_array($guest->preorder_drink) ? count($guest->preorder_drink) > 0 : strlen(trim($guest->preorder_drink)) > 0))
                                        <div class="d-flex flex-column gap-1">
                                            @if(is_array($guest->preorder_drink))
                                                @foreach($guest->preorder_drink as $index => $drinkName)
                                                    <span class="text-dark fw-medium d-inline-flex align-items-center" style="font-size: 0.85rem;">
                                                        <i class="bi bi-check2-circle text-success me-1"></i>
                                                        <small class="text-muted fw-light me-1">P{{ $index + 1 }}:</small> 
                                                        <span class="badge bg-light text-dark border-start border-warning border-3 rounded-1 px-2 py-0.5">
                                                            {{ trim($drinkName) ?: 'Aucun choix' }}
                                                        </span>
                                                    </span>
                                                @endforeach
                                            @else
                                                @foreach(array_filter(explode(',', $guest->preorder_drink)) as $index => $drinkName)
                                                    <span class="text-dark fw-medium d-inline-flex align-items-center" style="font-size: 0.85rem;">
                                                        <i class="bi bi-check2-circle text-success me-1"></i>
                                                        <small class="text-muted fw-light me-1">P{{ $index + 1 }}:</small> 
                                                        <span class="badge bg-light text-dark border-start border-warning border-3 rounded-1 px-2 py-0.5">
                                                            {{ trim($drinkName) }}
                                                        </span>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    @else
                                        <div class="bg-light p-3 rounded-3 no-print" style="max-width: 280px;">
                                            <small class="text-muted d-block mb-2 fw-bold text-uppercase" style="font-size: 0.7rem;">
                                                <i class="bi bi-info-circle me-1"></i> Choix pour les {{ $guest->access_count }} personnes :
                                            </small>
                                            
                                            <form action="{{ route('serveur.serve-drink', $guest->id) }}" method="POST" class="m-0">
                                                @csrf
                                                <div class="d-flex flex-column gap-2">
                                                    @for($i = 1; $i <= $guest->access_count; $i++)
                                                        <div class="d-flex align-items-center gap-1 mb-1">
                                                            <span class="badge bg-secondary rounded-1 small" style="font-size: 0.75rem; min-width: 24px;">P{{ $i }}</span>
                                                            <select name="drink_names[]" class="form-select form-select-sm py-1 shadow-sm" style="font-size: 0.8rem;" required>
                                                                <option value="" selected disabled>Choisir boisson...</option>
                                                                @php
                                                                    $drinksList = $wedding->drinks ?? (isset($wedding->id) ? DB::table('wedding_drinks')->where('wedding_id', $wedding->id)->get() : collect());
                                                                @endphp
                                                                @foreach($drinksList as $drink)
                                                                    <option value="{{ $drink->name }}">{{ $drink->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endfor
                                                </div>
                                                
                                                <button type="submit" class="btn btn-gold-luxe btn-sm w-100 py-2 mt-2 rounded-2 fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                                    <i class="bi bi-plus-lg me-1"></i> Valider les sélections
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    @if($guest->is_checked_in)
                                        <div class="mt-1">
                                            <button type="button" 
                                                    onclick="markAsServed({{ $guest->id }}, this)" 
                                                    class="btn btn-xs {{ ($guest->is_served ?? false) ? 'btn-success' : 'btn-outline-warning' }} rounded-pill px-2 py-0.5" 
                                                    style="font-size: 0.72rem; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem;"
                                                    {{ ($guest->is_served ?? false) ? 'disabled' : '' }}>
                                                <i class="bi {{ ($guest->is_served ?? false) ? 'bi-cup-straw' : 'bi-hand-index-thumb' }} me-1"></i>
                                                {{ ($guest->is_served ?? false) ? 'Servi ✓' : 'Marquer Servi' }}
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <div class="input-group input-group-sm w-auto no-print">
                                        <select class="form-select rounded-3" id="table_{{ $guest->id }}" onchange="saveAssignment({{ $guest->id }}, this)" @if(optional(auth()->user())->role === 'server') disabled style="background-color: #e9ecef; opacity: 0.8;" @endif>
                                            <option value="">Choisir Table...</option>
                                            @foreach($tables as $table)
                                                <option value="{{ $table->id }}" {{ $guest->wedding_table_id == $table->id ? 'selected' : '' }}>{{ $table->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    @if($guest->wedding_table_id)
                                        <div class="text-primary fw-bold small" style="font-size: 0.75rem;">
                                            Assigné : {{ $guest->weddingTable->name ?? 'Table #'.$guest->wedding_table_id }}
                                        </div>

                                        @if($guest->is_checked_in)
                                            <div class="mt-1">
                                                <button type="button" 
                                                        onclick="markAsSeated({{ $guest->id }}, this)" 
                                                        class="btn btn-xs {{ ($guest->is_seated ?? false) ? 'btn-dark' : 'btn-outline-primary' }} rounded-3 px-2 py-0.5" 
                                                        style="font-size: 0.72rem; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem;"
                                                        {{ ($guest->is_seated ?? false) ? 'disabled' : '' }}>
                                                    <i class="bi {{ ($guest->is_seated ?? false) ? 'bi-check-all' : 'bi-chair' }} me-1"></i>
                                                    {{ ($guest->is_seated ?? false) ? 'Installé ✓' : 'Confirmer Assis' }}
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            
                            <td class="text-center">
                                @if($guest->is_checked_in)
                                    <div class="text-success d-flex flex-column align-items-center">
                                        <i class="bi bi-patch-check-fill h4 mb-0"></i>
                                        <small class="text-muted small">Présent</small>
                                    </div>
                                @else
                                    <form action="{{ route('supervisor.checkin', $guest->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-dark rounded-pill no-print px-3">Valider</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Aucun invité trouvé dans la table d'invitations.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.guest-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });

    window.addEventListener('scroll', function() {
        let offset = window.pageYOffset;
        let parallax = document.getElementById('parallax');
        if(parallax) parallax.style.transform = "translateY(" + (offset * 0.4) + "px)";
    });

    let html5QrcodeScanner = null;

    function toggleScanner() {
        const readerDiv = document.getElementById('reader');
        const btn = document.getElementById('scannerToggle');
        
        if (readerDiv.style.display === 'none' || !readerDiv.style.display) {
            readerDiv.style.display = 'block';
            btn.innerHTML = '<i class="bi bi-camera-video-off me-2"></i> Fermer l\'appareil photo';
            btn.className = 'btn btn-danger w-100 py-3 rounded-4 shadow-sm';
            
            html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanError);
        } else {
            stopScanner();
        }
    }

    function stopScanner() {
        const readerDiv = document.getElementById('reader');
        const btn = document.getElementById('scannerToggle');
        
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear().catch(error => console.error(error));
            html5QrcodeScanner = null;
        }
        readerDiv.style.display = 'none';
        btn.innerHTML = '<i class="bi bi-qr-code-scan me-2"></i> Scanner Ticket QR';
        btn.className = 'btn btn-dark w-100 py-3 rounded-4 shadow-sm';
    }

    function onScanSuccess(decodedText, decodedResult) {
        stopScanner();
        let token = decodedText;
        if (decodedText.includes('/')) {
            token = decodedText.split('/').pop();
        }
        window.location.href = `/supervisor/check-in-qr/${token}`;
    }

    function onScanError(err) {}

    // Correction de l'URL cible d'assignation dynamique
    function saveAssignment(guestId, selectElement) {
        const tableId = selectElement.value;
        selectElement.classList.add('border-warning');
        selectElement.disabled = true;

        fetch('/supervisor/assign-table', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                guest_id: guestId,
                table_id: tableId
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                location.reload();
            } else {
                alert("Erreur : " + data.message);
                selectElement.classList.remove('border-warning');
                selectElement.disabled = false;
            }
        })
        .catch(error => {
            console.error('Erreur d\'assignation:', error);
            alert("Une erreur technique est survenue.");
            selectElement.classList.remove('border-warning');
            selectElement.disabled = false;
        });
    }

    function markAsSeated(guestId, button) {
        if(!confirm("Confirmer que cet invité est bien installé à sa table ?")) return;
        button.disabled = true;

        fetch(`/guest/set-seated/${guestId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error("Erreur serveur");
            return response.json();
        })
        .then(data => {
            if(data.success) {
                button.className = "btn btn-xs btn-dark rounded-3 py-1 small";
                button.innerHTML = "<i class='bi bi-check-all me-1'></i> Installé ✓";
                setTimeout(() => { location.reload(); }, 600);
            } else {
                alert("Erreur : " + data.message);
                button.disabled = false;
            }
        })
        .catch(error => {
            alert("Une erreur technique est survenue.");
            button.disabled = false;
        });
    }

    function markAsServed(guestId, button) {
        if(!confirm("Valider que la commande de boisson a bien été servie ?")) return;
        button.disabled = true;

        fetch(`/guest/set-served/${guestId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error("Erreur serveur");
            return response.json();
        })
        .then(data => {
            if(data.success) {
                button.className = "btn btn-xs btn-success rounded-pill px-2 py-1 small";
                button.innerHTML = "<i class='bi bi-cup-straw me-1'></i> Servie ✓";
                setTimeout(() => { location.reload(); }, 600);
            } else {
                alert("Erreur : " + data.message);
                button.disabled = false;
            }
        })
        .catch(error => {
            alert("Une erreur technique est survenue.");
            button.disabled = false;
        });
    }
</script>
</body>
</html>