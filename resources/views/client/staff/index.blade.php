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
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #fdfbf7;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(197, 160, 89, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(197, 160, 89, 0.05) 0%, transparent 20%),
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23c5a059' fill-opacity='0.08' fill-rule='evenodd'/%3E%3C/svg%3E");
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), 
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: clamp(60px, 8vw, 90px) 20px clamp(90px, 11vw, 120px) 20px;
            border-radius: 0 0 clamp(40px, 6vw, 80px) clamp(40px, 6vw, 80px);
            text-align: center;
            color: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            position: relative;
        }

        .hero-section h1 { 
            font-family: 'Playfair Display', serif; 
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            margin-bottom: 0.5rem;
        }
        
        .hero-section p {
            font-size: clamp(0.95rem, 2vw, 1.2rem);
        }

        .glass-form {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
            border-radius: clamp(24px, 4vw, 40px);
            padding: clamp(20px, 4vw, 45px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.04);
        }

        .input-luxury {
            background: white !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 14px !important;
            padding: 12px 18px !important;
            transition: 0.3s !important;
            font-size: 0.95rem;
        }

        .input-luxury:focus {
            border-color: var(--luxury-gold) !important;
            box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.15) !important;
        }

        .btn-prestige {
            background: linear-gradient(135deg, var(--luxury-gold), #b38f4d);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        @media (min-width: 992px) {
            .btn-prestige:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 25px rgba(197, 160, 89, 0.35);
                color: white;
            }
        }

        .member-card {
            background: white;
            border-radius: 20px;
            padding: clamp(15px, 3vw, 22px);
            border: 1px solid rgba(197, 160, 89, 0.1);
            transition: all 0.3s ease;
        }

        @media (min-width: 992px) {
            .member-card:hover {
                border-color: var(--luxury-gold);
                box-shadow: 0 15px 30px rgba(197, 160, 89, 0.06);
            }
        }

        .icon-badge {
            width: clamp(45px, 6vw, 55px);
            height: clamp(45px, 6vw, 55px);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1.1rem, 2vw, 1.3rem);
            flex-shrink: 0;
        }

        .staff-scroll {
            max-height: 600px; 
            overflow-y: auto; 
            padding-right: 4px;
        }

        .staff-scroll::-webkit-scrollbar { width: 5px; }
        .staff-scroll::-webkit-scrollbar-track { background: transparent; }
        .staff-scroll::-webkit-scrollbar-thumb { background: var(--luxury-gold); border-radius: 10px; }

        .custom-margin-top {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 575.98px) {
            .custom-margin-top {
                margin-top: -35px;
            }
            .btn-return-mobile {
                position: static !important;
                margin-bottom: 10px;
                display: inline-block;
            }
        }
    </style>
</head>
<body>

<header class="hero-section">
    <div class="container">
        <a href="{{ route('client.dashboard') }}" class="btn btn-link text-white position-absolute top-0 start-0 mt-3 ms-3 fs-3 btn-return-mobile" title="Retour au tableau de bord">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <h1>Maîtres de Cérémonie</h1>
        <p class="lead fw-light">Gérer les ambassadeurs de votre grand jour</p>
    </div>
</header>

<div class="container custom-margin-top pb-5 px-3">
    
    {{-- Notifications d'erreurs éventuelles --}}
    @if(session('error'))
        <div class="alert alert-danger rounded-4 shadow-sm mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="row g-4">
        
        <div class="col-lg-5">
            <div class="glass-form h-100">
                <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Nouvelle affectation</h3>
                <form action="{{ route('client.staff.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2 ms-1 text-uppercase">Nom du Collaborateur</label>
                        <input type="text" name="name" class="form-control input-luxury" placeholder="ex: Antoine Kabeya" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2 ms-1 text-uppercase">Numéro WhatsApp</label>
                        <input type="tel" name="phone" class="form-control input-luxury" placeholder="ex: 243..." required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2 ms-1 text-uppercase">Email Professionnel</label>
                        <input type="email" name="email" class="form-control input-luxury" placeholder="staff@weddream.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="small fw-bold text-muted mb-2 ms-1 text-uppercase">Rôle Assigné</label>
                        <select name="role" class="form-select input-luxury">
                            <option value="supervisor">Superviseur (Sécurité & Accueil)</option>
                            <option value="server">Maître de Table (Service Or)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-prestige w-100 shadow-sm">
                        Valider l'adhésion <i class="bi bi-check2-all ms-1"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="glass-form h-100">
                <div class="d-flex flex-row justify-content-between align-items-center mb-4 gap-2">
                    <h3 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; font-size: clamp(1.3rem, 2.5vw, 1.75rem);">Effectif Actuel</h3>
                    <span class="badge bg-white text-gold border border-gold rounded-pill px-3 py-2 shadow-sm flex-shrink-0" style="color: var(--luxury-gold); font-size: 0.85rem;">
                        {{ count($staff) }} Membres
                    </span>
                </div>

                <div class="staff-scroll">
                    @forelse($staff as $member)
                    <div class="member-card d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3 shadow-sm bg-white border-start border-4 {{ $member->role == 'supervisor' ? 'border-primary' : 'border-warning' }} mb-3">
                        
                        <div class="d-flex align-items-center">
                            <div class="icon-badge {{ $member->role == 'supervisor' ? 'bg-primary text-white' : 'bg-warning text-dark' }} shadow-sm me-3">
                                <i class="bi {{ $member->role == 'supervisor' ? 'bi-shield-check' : 'bi-cup-straw' }}"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-dark text-truncate">{{ $member->name }}</h6>
                                <div class="small text-muted text-truncate mt-1">
                                    <i class="bi bi-whatsapp text-success me-1"></i>{{ $member->phone ?? 'S/N' }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end align-items-center mt-2 mt-sm-0 border-top pt-2 pt-sm-0 border-sm-top-0">
                            
                            @if($member->phone)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $member->phone);
                                    $loginUrl = url('/login') . '/';
                                    
                                    // RESTRUCTURÉ : Lien propre et isolé
                                    $waMessage = "✨ *Rappel Accès Staff WedDream* ✨\n\n" .
                                                 "Bonjour {$member->name},\n" .
                                                 "Voici tes identifiants de connexion :\n" .
                                                 "📧 *Email* : {$member->email}\n\n" .
                                                 "🔗 *Lien de connexion* :\n" .
                                                 "{$loginUrl}\n\n" .
                                                 "Ton mot de passe t'a été envoyé lors de ton adhésion.";
                                @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode($waMessage) }}" 
                                   target="_blank" 
                                   class="btn btn-md btn-light text-success rounded-3 border shadow-sm px-3 py-2" 
                                   title="Envoyer un rappel WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            @endif

                            <form action="{{ route('client.staff.reset', $member->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-md btn-light text-dark rounded-3 border shadow-sm px-3 py-2" title="Générer et envoyer un nouveau code">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </form>

                            <form action="{{ route('client.staff.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment retirer ce membre ?');" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md btn-light text-danger rounded-3 border shadow-sm px-3 py-2">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-people text-muted display-2 mb-3 opacity-25"></i>
                        <p class="text-muted small italic">Votre équipe de prestige est vide.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT D'OUVERTURE AUTOMATIQUE --}}
{{-- Utilise l'URL exacte générée par store() ou resetPassword() dans ton contrôleur --}}
@if(session('waUrl'))
<script>
    setTimeout(function() {
        window.open("{{ session('waUrl') }}", '_blank');
    }, 500);
</script>
@endif

</body>
</html>