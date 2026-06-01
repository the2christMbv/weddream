<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Gestion de l'Équipe Élite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap');
        
        :root {
            --luxury-gold: #c5a059;
            --soft-gold: #f1d299;
            --dark-silk: #111827;
            --glass-bg: rgba(255, 255, 255, 0.85);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #fdfbf7;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(197, 160, 89, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(197, 160, 89, 0.05) 0%, transparent 20%),
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23c5a059' fill-opacity='0.08' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            height: 350px;
            border-radius: 0 0 80px 80px;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .hero-section h1 { font-family: 'Playfair Display', serif; font-size: 3.5rem; }

        .glass-form {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 40px;
            padding: 45px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.05);
        }

        .input-luxury {
            background: white !important;
            border: 1px solid #eee !important;
            border-radius: 18px !important;
            padding: 14px 20px !important;
            transition: 0.3s !important;
        }

        .input-luxury:focus {
            border-color: var(--luxury-gold) !important;
            box-shadow: 0 0 0 5px rgba(197, 160, 89, 0.1) !important;
        }

        .btn-prestige {
            background: linear-gradient(135deg, var(--luxury-gold), #b38f4d);
            color: white;
            border: none;
            border-radius: 18px;
            padding: 18px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: 0.4s;
        }

        .btn-prestige:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(197, 160, 89, 0.4);
            color: white;
        }

        .member-card {
            background: white;
            border-radius: 25px;
            padding: 25px;
            border: 1px solid rgba(197, 160, 89, 0.1);
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .member-card:hover {
            border-color: var(--luxury-gold);
            box-shadow: 0 20px 40px rgba(197, 160, 89, 0.08);
        }

        .icon-badge {
            width: 55px;
            height: 55px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* Scrollbar élégante */
        .staff-scroll::-webkit-scrollbar { width: 5px; }
        .staff-scroll::-webkit-scrollbar-track { background: transparent; }
        .staff-scroll::-webkit-scrollbar-thumb { background: var(--luxury-gold); border-radius: 10px; }
    </style>
</head>
<body>

<header class="hero-section">
    <div class="container">
        <a href="{{ route('client.dashboard') }}" class="btn btn-link text-white position-absolute top-0 start-0 mt-4 ms-4 fs-3">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <h1 class="display-3">Maîtres de Cérémonie</h1>
        <p class="lead fw-light">Gérez les ambassadeurs de votre grand jour.</p>
    </div>
</header>

<div class="container mt-n5 pb-5">
    <div class="row g-5">
        <!-- FORMULAIRE D'AJOUT -->
        <div class="col-lg-5">
            <div class="glass-form">
                <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Nouvelle affectation</h3>
                <form action="{{ route('client.staff.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2 ms-2 text-uppercase">Nom du Collaborateur</label>
                        <input type="text" name="name" class="form-control input-luxury" placeholder="ex: Antoine Kabeya" required>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="small fw-bold text-muted mb-2 ms-2 text-uppercase">Numéro WhatsApp</label>
                            <input type="tel" name="phone" class="form-control input-luxury" placeholder="ex: 243..." required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small fw-bold text-muted mb-2 ms-2 text-uppercase">Email Professionnel</label>
                            <input type="email" name="email" class="form-control input-luxury" placeholder="staff@weddream.com" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted mb-2 ms-2 text-uppercase">Rôle Assigné</label>
                        <select name="role" class="form-select input-luxury">
                            <option value="supervisor">Superviseur (Sécurité & Accueil)</option>
                            <option value="server">Maître de Table (Service Or)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-prestige w-100 shadow">
                        Valider l'adhésion <i class="bi bi-check2-all ms-2"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- LISTE DES MEMBRES -->
        <div class="col-lg-7">
            <div class="glass-form h-100">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif;">Effectif Actuel</h3>
                    <span class="badge bg-white text-gold border border-gold rounded-pill px-3 py-2 shadow-sm" style="color: var(--luxury-gold);">
                        {{ count($staff) }} Membres
                    </span>
                </div>

                <div class="staff-scroll" style="max-height: 600px; overflow-y: auto; padding-right: 10px;">
                    @forelse($staff as $member)
                    <div class="member-card d-flex align-items-center justify-content-between shadow-sm bg-white border-start border-4 {{ $member->role == 'supervisor' ? 'border-primary' : 'border-warning' }}">
                        <div class="d-flex align-items-center">
                            <div class="icon-badge {{ $member->role == 'supervisor' ? 'bg-primary text-white' : 'bg-warning text-dark' }} shadow-sm me-3">
                                <i class="bi {{ $member->role == 'supervisor' ? 'bi-shield-check' : 'bi-cup-straw' }}"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $member->name }}</h6>
                                <div class="small text-muted">
                                    <i class="bi bi-whatsapp text-success me-1"></i>{{ $member->phone ?? 'S/N' }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <!-- BOUTON WHATSAPP (RAPPEL IDENTIFIANTS) -->
                            @if($member->phone)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $member->phone);
                                    $waMessage = "✨ *Rappel Accès Staff WedDream* ✨\n\n" .
                                                 "Bonjour " . $member->name . ",\n" .
                                                 "Voici tes identifiants :\n" .
                                                 "📧 *Email* : " . $member->email . "\n" .
                                                 "🔗 *Lien* : " . url('/') . "\n\n" .
                                                 "Ton mot de passe t'a été envoyé lors de ton adhésion.";
                                @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode($waMessage) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-light text-success rounded-3 border shadow-sm" 
                                   title="Envoyer un rappel WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            @endif

                            <!-- BOUTON RÉINITIALISER (ENVOIE NOUVEAU CODE) -->
                            <form action="{{ route('client.staff.reset', $member->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-light text-dark rounded-3 border shadow-sm" title="Générer et envoyer un nouveau code">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </form>

                            <!-- BOUTON SUPPRIMER -->
                            <form action="{{ route('client.staff.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment retirer ce membre ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-3 border shadow-sm">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-people text-muted display-1 mb-4 opacity-25"></i>
                        <p class="text-muted italic">Votre équipe de prestige est vide.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script pour l'ouverture automatique de WhatsApp (Action Store/Reset) --}}
@if(session('waUrl'))
<script>
    // Délai de 500ms pour laisser la page se charger avant d'ouvrir WhatsApp
    setTimeout(function() {
        window.open("{{ session('waUrl') }}", '_blank');
    }, 500);
</script>
@endif

</body>
</html>