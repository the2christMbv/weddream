<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Gestion des Invitations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            margin: 0;
            padding: 0;
        }

        .banner-invitation {
            background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), 
                        url('{{ $wedding && $wedding->cover_photo ? asset("storage/" . $wedding->cover_photo) : "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069" }}');
            background-size: cover;
            background-position: center;
            padding: clamp(40px, 6vw, 70px) 20px;
            color: white;
            text-align: center;
            border-bottom: 3px solid var(--gold);
            position: relative;
        }

        .banner-invitation h1 {
            font-family: 'Cinzel', serif;
            letter-spacing: clamp(2px, 1vw, 6px);
            text-transform: uppercase;
            font-weight: 700;
            font-size: clamp(1.8rem, 4vw, 3rem);
        }

        .stat-card {
            background: var(--dark);
            color: var(--gold);
            border-radius: 12px;
            padding: clamp(12px, 2vw, 20px);
            border: 1px solid var(--gold);
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .stat-card h3 { 
            font-family: 'Cinzel', serif; 
            margin-bottom: 0; 
            font-weight: 700;
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
        }
        
        .stat-card p { 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            margin: 0; 
            opacity: 0.8; 
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.06);
            background: white;
            overflow: hidden;
        }

        .card-header-gold {
            background: var(--dark);
            color: var(--gold);
            padding: 1.25rem;
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
            transition: 0.3s ease;
            border-radius: 50px;
        }

        @media (min-width: 992px) {
            .btn-gold:hover { 
                background: #b38728; 
                color: white; 
                transform: translateY(-2px); 
            }
        }

        /* Ajustements d'affichage et correctifs Mobile */
        @media (max-width: 575.98px) {
            .btn-return-mobile {
                position: static !important;
                margin: 0 auto 15px auto !important;
                display: inline-flex !important;
            }
            .table-responsive table {
                font-size: 0.9rem;
            }
            .action-buttons {
                flex-direction: column-reverse;
                align-items: flex-end;
                gap: 5px;
            }
        }
    </style>
</head>
<body>

<section class="banner-invitation mb-5">
    <div class="container">
        <a href="{{ route('client.dashboard') }}" class="btn btn-outline-light position-absolute top-0 start-0 mt-4 ms-4 rounded-circle d-flex align-items-center justify-content-center btn-return-mobile" style="width: 45px; height: 45px; border-color: var(--gold); color: var(--gold); transition: 0.3s;" title="Retour au tableau de bord">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>

        <h1>WedDream</h1>
        <p class="lead small text-uppercase tracking-wider opacity-75">Gestionnaire d'Invitations de Prestige</p>
        
        <div class="row mt-4 g-3 justify-content-center">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="stat-card">
                    <h3>
                        {{ count($invitations ?? []) }} 
                        @if(isset($wedding->max_invitations) && $wedding->max_invitations > 0)
                            <span class="fs-5 opacity-50">/ {{ $wedding->max_invitations }}</span>
                        @endif
                    </h3>
                    <p>Invitations Générées</p>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3">
                <div class="stat-card">
                    <h3 id="totalPersonnes">0</h3>
                    <p>Total Personnes</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container pb-5 px-3">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            
            @if(isset($wedding->max_invitations) && $wedding->max_invitations > 0)
                @php
                    $countCurrent = count($invitations ?? []);
                    $percentage = ($countCurrent / $wedding->max_invitations) * 100;
                @endphp

                @if($countCurrent >= $wedding->max_invitations)
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-3 p-3 text-center small">
                        <i class="bi bi-x-circle-fill d-block fs-4 mb-1"></i>
                        <strong>Quota maximal atteint !</strong><br>Vous ne pouvez plus générer de nouvelles cartes d'invitation.
                    </div>
                @elseif($percentage >= 80)
                    <div class="alert alert-warning border-0 shadow-sm rounded-4 mb-3 p-3 small">
                        <i class="bi bi-exclamation-diamond-fill me-1 text-warning"></i>
                        <strong>Attention :</strong> Vous approchez de votre limite de prestige ({{ $countCurrent }} sur {{ $wedding->max_invitations }} utilisées).
                    </div>
                @endif
            @endif

            <div class="card card-custom mb-4 shadow-sm">
                <div class="card-header-gold text-center">
                    <h5 class="mb-0">Créer un accès</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('invitations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nom du Destinataire</label>
                            <input type="text" name="guest_name" class="form-control py-2 shadow-sm" placeholder="Ex: Famille Robert" required 
                            {{ isset($wedding->max_invitations) && $wedding->max_invitations > 0 && count($invitations ?? []) >= $wedding->max_invitations ? 'disabled' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Type</label>
                            <select name="type" class="form-select py-2 shadow-sm" id="invitationType" 
                            {{ isset($wedding->max_invitations) && $wedding->max_invitations > 0 && count($invitations ?? []) >= $wedding->max_invitations ? 'disabled' : '' }}>
                                <option value="singleton" data-count="1">💍 Singleton (1 Pers.)</option>
                                <option value="couple" data-count="2">🥂 Couple (2 Pers.)</option>
                                <option value="groupe" data-count="5">🎊 Groupe (Plusieurs)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nombre de Places</label>
                            <input type="number" name="access_count" id="accessCount" class="form-control py-2 shadow-sm" value="1" min="1" 
                            {{ isset($wedding->max_invitations) && $wedding->max_invitations > 0 && count($invitations ?? []) >= $wedding->max_invitations ? 'disabled' : '' }}>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Téléphone WhatsApp</label>
                            <input type="text" name="phone" class="form-control py-2 shadow-sm" placeholder="243810000000" 
                            {{ isset($wedding->max_invitations) && $wedding->max_invitations > 0 && count($invitations ?? []) >= $wedding->max_invitations ? 'disabled' : '' }}>
                        </div>

                        @if(isset($wedding->max_invitations) && $wedding->max_invitations > 0 && count($invitations ?? []) >= $wedding->max_invitations)
                            <button type="button" class="btn btn-secondary w-100 shadow text-uppercase" disabled>Limite Atteinte</button>
                        @else
                            <button type="submit" class="btn btn-gold w-100 shadow text-uppercase">Générer l'accès</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-custom h-100 shadow-sm">
                <div class="card-header-gold d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Carnet d'Adresses</h5>
                    <span class="badge bg-white text-dark py-2 px-3 rounded-pill">{{ count($invitations ?? []) }} Liens</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-uppercase small text-muted">
                                <tr>
                                    <th class="ps-4 py-3">Destinataire</th>
                                    <th class="py-3">Catégorie</th>
                                    <th class="text-center py-3">Places</th>
                                    <th class="py-3">WhatsApp</th>
                                    <th class="pe-4 text-end py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invitations as $invitation)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark text-truncate" style="max-width: 180px;">{{ $invitation->guest_name }}</div>
                                            <div class="text-muted small">{{ $invitation->phone ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace">{{ strtoupper($invitation->type) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="count-cell fw-bold" style="color: #b8860b;">
                                                {{ $invitation->access_count }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
    // Votre logique existante est correcte
    $groom = explode(' ', $wedding->groom_name)[0];
    $bride = explode(' ', $wedding->bride_name)[0];
    
    // On construit le message avec ces variables
    $message = "✨ 𝐢𝐧𝐯𝐢𝐭𝐚𝐭𝐢𝐨𝐧 ✨" . PHP_EOL . PHP_EOL . 
               "*" . strtoupper($invitation->guest_name) . "*," . PHP_EOL . PHP_EOL . 
               $groom . " & " . $bride . " sont très heureux de vous inviter à leur mariage." . PHP_EOL . PHP_EOL . 
               "Nous avons hâte de célébrer ce moment avec vous ! Cliquez sur le lien ci-dessous pour découvrir le programme détaillé et confirmer votre présence.👇🏼" . PHP_EOL . PHP_EOL . 
               route('guest.welcome', $invitation->link_token);
@endphp

<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $invitation->phone) }}?text={{ urlencode($message) }}" 
   target="_blank" 
   class="btn btn-success btn-sm rounded-pill px-3">
    <i class="bi bi-whatsapp me-1"></i> Envoyer
</a>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-flex justify-content-end align-items-center gap-2 action-buttons">
                                                <a href="{{ route('invitation.print', $invitation->id) }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill px-3 py-1">
                                                    <i class="bi bi-printer me-1"></i> Format Papier
                                                </a>

                                                <form action="{{ route('invitations.destroy', $invitation->id) }}" method="POST" class="m-0" onsubmit="return confirm('Retirer cet invité ?');">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-1 align-middle" title="Supprimer">
                                                        <i class="bi bi-trash3 fs-5"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted small">
                                            <i class="bi bi-card-list display-4 d-block mb-3 opacity-25"></i>
                                            Aucun invité trouvé dans votre liste de prestige.
                                        </td>
                                    </tr>
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
        const totalEl = document.getElementById('totalPersonnes');
        if(totalEl) totalEl.innerText = total;
    }

    const invType = document.getElementById('invitationType');
    if(invType) {
        invType.addEventListener('change', function() {
            let countInput = document.getElementById('accessCount');
            let selectedOption = this.options[this.selectedIndex];
            if(countInput && selectedOption) {
                countInput.value = selectedOption.getAttribute('data-count');
            }
        });
    }

    window.onload = calculerTotal;
</script>
</body>
</html>