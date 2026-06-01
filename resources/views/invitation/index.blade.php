<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Gestion des Invitations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap');

        :root {
            --gold: #c5a059;
            --dark: #1a1a1a;
            --light-gold: #f4e8c1;
        }

        body {
            background-color: #fcfcfc;
            background-image: radial-gradient(var(--gold) 0.5px, transparent 0.5px);
            background-size: 30px 30px;
            font-family: 'Montserrat', sans-serif;
        }

        .banner-invitation {
            /* Utilisation dynamique de la cover_photo du couple ou image par défaut */
            background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), 
                        url('{{ $wedding && $wedding->cover_photo ? asset("storage/" . $wedding->cover_photo) : "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069" }}');
            background-size: cover;
            background-position: center;
            padding: 60px 0;
            color: white;
            text-align: center;
            border-bottom: 3px solid var(--gold);
        }

        .banner-invitation h1 {
            font-family: 'Cinzel', serif;
            letter-spacing: 6px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .stat-card {
            background: var(--dark);
            color: var(--gold);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--gold);
            text-align: center;
            transition: 0.3s;
        }

        .stat-card h3 { font-family: 'Cinzel', serif; margin-bottom: 0; font-weight: 700; }
        .stat-card p { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin: 0; opacity: 0.8; }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            background: white;
            overflow: hidden;
        }

        .card-header-gold {
            background: var(--dark);
            color: var(--gold);
            padding: 1.5rem;
            font-family: 'Cinzel', serif;
            border-bottom: 2px solid var(--gold);
        }

        .btn-gold {
            background: var(--gold);
            color: white;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            border: none;
            padding: 12px;
            transition: 0.4s;
            border-radius: 50px;
        }

        .btn-gold:hover { background: #b38728; color: white; transform: translateY(-2px); }
    </style>
</head>
<body>

<section class="banner-invitation mb-5 position-relative">
    <div class="container">
        <a href="{{ route('client.dashboard') }}" class="btn btn-outline-light position-absolute top-0 start-0 mt-4 ms-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border-color: var(--gold); color: var(--gold); transition: 0.3s;" title="Retour au tableau de bord">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>

        <h1>WedDream</h1>
        <p class="lead">Gestionnaire d'Invitations de Prestige</p>
        
        <div class="row mt-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <h3>{{ count($invitations ?? []) }}</h3>
                    <p>Invitations</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <h3 id="totalPersonnes">0</h3>
                    <p>Total Personnes</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card card-custom mb-4">
                    <div class="card-header-gold text-center">
                        <h5 class="mb-0">Créer un accès</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('invitations.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nom du Destinataire</label>
                                <input type="text" name="guest_name" class="form-control shadow-sm" placeholder="Ex: Famille Robert" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Type</label>
                                <select name="type" class="form-select shadow-sm" id="invitationType">
                                    <option value="singleton" data-count="1">💍 Singleton (1 Pers.)</option>
                                    <option value="couple" data-count="2">🥂 Couple (2 Pers.)</option>
                                    <option value="groupe" data-count="5">🎊 Groupe (Plusieurs)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nombre de Places</label>
                                <input type="number" name="access_count" id="accessCount" class="form-control shadow-sm" value="1" min="1">
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">Téléphone WhatsApp</label>
                                <input type="text" name="phone" class="form-control shadow-sm" placeholder="243810000000">
                            </div>

                            <button type="submit" class="btn btn-gold w-100 shadow text-uppercase">Générer l'accès</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card card-custom h-100 shadow-sm">
                    <div class="card-header-gold d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Carnet d'Adresses</h5>
                        <span class="badge bg-white text-dark">{{ count($invitations ?? []) }} Liens</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-uppercase small text-muted">
                                    <tr>
                                        <th class="ps-4">Destinataire</th>
                                        <th>Catégorie</th>
                                        <th class="text-center">Places</th>
                                        <th>WhatsApp</th>
                                        <th class="pe-4 text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($invitations as $invitation)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="fw-bold">{{ $invitation->guest_name }}</div>
                                                <div class="text-muted small">{{ $invitation->phone ?? 'N/A' }}</div>
                                            </td>
                                            <td><span class="badge bg-light text-dark border">{{ strtoupper($invitation->type) }}</span></td>
                                            <td class="text-center">
                                                <div class="count-cell fw-bold" style="color: #b8860b;">
                                                    {{ $invitation->access_count }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm rounded-pill"><i class="bi bi-whatsapp"></i> Envoyer</a>
                                            </td>
                                            <td class="pe-4 text-end">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <a href="{{ route('invitation.print', $invitation->id) }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill me-2">
                                                        <i class="bi bi-printer"></i> Version Papier
                                                    </a>

                                                    <form action="{{ route('invitations.destroy', $invitation->id) }}" method="POST" class="m-0">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger p-0 align-middle"><i class="bi bi-trash3 fs-5"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center py-5">Aucun invité trouvé.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculerTotal() {
            let total = 0;
            document.querySelectorAll('.count-cell').forEach(cell => {
                total += parseInt(cell.innerText.trim()) || 0;
            });
            document.getElementById('totalPersonnes').innerText = total;
        }

        document.getElementById('invitationType').addEventListener('change', function() {
            let countInput = document.getElementById('accessCount');
            let selectedOption = this.options[this.selectedIndex];
            countInput.value = selectedOption.getAttribute('data-count');
        });

        window.onload = calculerTotal;
    </script>
</body>
</html>