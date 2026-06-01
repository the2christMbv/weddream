<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Excellence Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&family=Cormorant+Garamond:ital,wght@0,600;1,600&display=swap');
        
        :root {
            --wed-gold: #c5a059;
            --wed-dark: #0f172a;
            --wed-sidebar: #1e293b;
            --wed-bg: #f8fafc;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--wed-bg);
            color: var(--wed-dark);
            overflow-x: hidden;
        }

        .sidebar { 
            background: var(--wed-sidebar);
            min-height: 100vh; 
            position: fixed; 
            z-index: 100;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .nav-link {
            color: rgba(255,255,255,0.6);
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(197, 160, 89, 0.1);
            color: var(--wed-gold) !important;
        }

        .main-content { 
            margin-left: 16.666667%; 
            background: url('https://www.transparenttextures.com/patterns/white-diamond.png'); 
            min-height: 100vh;
            padding: 2rem;
        }

        .luxury-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--wed-dark);
        }

        .card { 
            border-radius: 24px; 
            border: none; 
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            background: #fcfcfc;
        }

        .btn-luxury { 
            background: linear-gradient(135deg, #c5a059 0%, #af8d4a 100%);
            border: none; 
            border-radius: 14px; 
            padding: 14px;
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(197, 160, 89, 0.3);
        }

        .badge-date { 
            background: #fffbeb; 
            color: #b45309; 
            border: 1px solid #fef3c7;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 0.85rem;
        }

        .couple-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .section-divider {
            border-left: 3px solid var(--wed-gold);
            padding-left: 10px;
            margin: 20px 0 15px 0;
            color: var(--wed-gold);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-md-2 sidebar p-4 d-flex flex-column">
                <div class="text-center mb-5">
                    <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid" style="filter: brightness(0) invert(1);" alt="Logo">
                    <div class="mt-3 small text-uppercase" style="color: var(--wed-gold); letter-spacing: 2px;">Excellence Admin</div>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-fill me-3"></i> Dashboard
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-heart-fill me-3"></i> Mariages
                    </a>
                    <a class="nav-link" href="{{ route('admin.magazine') }}">
                        <i class="bi bi-book-half me-3"></i> Magazine Souvenir
                    </a>
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-3"></i> Profil
                    </a>
                    
                    <div class="mt-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link text-white-50 text-decoration-none small p-0 w-100 text-start border-0 bg-transparent">
                                <i class="bi bi-box-arrow-left me-2"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <span class="text-muted text-uppercase small">WedDream Prestige</span>
                        <h1 class="luxury-title">Gestion des Événements</h1>
                    </div>
                    <div class="bg-white p-2 rounded-pill shadow-sm border px-3">
                        <span class="small fw-bold"><i class="bi bi-shield-check text-success me-2"></i>{{ Auth::user()->name }}</span>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                        <i class="bi bi-stars me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="row g-4">
                    <div class="col-xl-4">
                        <div class="card p-4">
                            <h4 class="mb-4 fw-bold">Nouveau Dossier</h4>
                            <form action="{{ route('admin.wedding.store') }}" method="POST">
                                @csrf
                                <div class="section-divider">Identité du Couple</div>
                                <div class="mb-3">
                                    <input type="text" name="bride_name" class="form-control mb-2" placeholder="Nom de la Mariée" required>
                                    <input type="text" name="groom_name" class="form-control" placeholder="Nom du Marié" required>
                                </div>

                                <div class="mb-3">
                                    <label class="small text-muted fw-bold">Contact WhatsApp</label>
                                    <input type="text" name="contact_phone" class="form-control" placeholder="243..." required>
                                </div>

                                <div class="mb-3">
                                    <label class="small text-muted fw-bold">Email de connexion</label>
                                    <input type="email" name="email" class="form-control" placeholder="client@exemple.com" required>
                                </div>

                                <div class="section-divider">Date de l'événement</div>
                                <div class="row g-2 mb-4">
                                    <div class="col-7"><input type="date" name="reception_date" class="form-control" required></div>
                                    <div class="col-5"><input type="time" name="reception_time" class="form-control"></div>
                                </div>

                                <button type="submit" class="btn btn-luxury w-100">
                                    Enregistrer & Envoyer Accès <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold m-0">Mariages Enregistrés</h4>
                                <span class="badge bg-dark rounded-pill px-3 py-2">{{ count($weddings) }} Couples</span>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Couple & Contact</th>
                                            <th>Date Réception</th>
                                            <th>Email Client</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($weddings as $w)
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $w->contact_phone);
                                            $clientLink = route('wedding.client.space');
                                            
                                            $reconstructedPassword = strtolower(\Illuminate\Support\Str::slug($w->groom_name)) . "2026";
                                            
                                            $waMessage = "✨ *Vos accès WedDream* ✨\n\n";
                                            $waMessage .= "Accédez à votre espace ici :\n🔗 " . $clientLink . "\n\n";
                                            $waMessage .= "🔐 *Identifiants :*\n";
                                            $waMessage .= "Email : " . ($w->user->email ?? 'N/A') . "\n";
                                            $waMessage .= "Mot de passe : " . $reconstructedPassword;
                                            
                                            $encodedMessage = rawurlencode($waMessage);
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="couple-name text-dark">{{ $w->bride_name }} & {{ $w->groom_name }}</div>
                                                <div class="small text-success"><i class="bi bi-whatsapp me-1"></i>{{ $w->contact_phone }}</div>
                                            </td>
                                            <td>
                                                <div class="badge-date d-inline-block">
                                                    <i class="bi bi-calendar-event me-1"></i>
                                                    {{ $w->reception_date ? \Carbon\Carbon::parse($w->reception_date)->format('d/m/Y') : 'À définir' }}
                                                </div>
                                            </td>
                                            <td class="text-muted small">{{ $w->user->email ?? 'N/A' }}</td>
                                            <td class="text-end">
                                                <div class="btn-group shadow-sm rounded-3">
                                                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ $encodedMessage }}" 
                                                       target="_blank" 
                                                       class="btn btn-sm btn-success px-3" 
                                                       title="Renvoyer les accès">
                                                        <i class="bi bi-whatsapp me-1"></i> Renvoyer
                                                    </a>
                                                    <a href="{{ route('admin.magazine') }}" class="btn btn-sm btn-light border-start" title="Voir le livre d'or / Magazine">
                                                        <i class="bi bi-book-half text-secondary"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-light border-start">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                                Aucun mariage enregistré.
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
    </div>
</body>
</html>