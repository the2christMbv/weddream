<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Liste des Magazines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap');
        
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
        
        /* Sidebar - Masquée par défaut sur mobile, gérée par media queries */
        .sidebar { 
            background: var(--wed-sidebar); 
            min-height: 100vh; 
            position: fixed; 
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000; 
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            border-right: 1px solid rgba(255,255,255,0.05);
            display: none !important;
        }
        
        /* Top Navbar Mobile */
        .mobile-navbar {
            background: var(--wed-sidebar);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .mobile-toggle-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1.5rem;
            padding: 4px 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .mobile-toggle-btn:hover {
            border-color: var(--wed-gold);
            color: var(--wed-gold);
        }

        /* Liens de navigation */
        .nav-link { 
            color: rgba(255,255,255,0.6); 
            border-radius: 12px; 
            padding: 12px 15px; 
            margin-bottom: 8px; 
            transition: all 0.3s ease; 
            text-decoration: none; 
            font-weight: 500;
        }
        
        .nav-link:hover, .nav-link.active { 
            background: rgba(197, 160, 89, 0.1); 
            color: var(--wed-gold) !important; 
        }
        
        /* Zone de contenu principale */
        .main-content { 
            background: url('https://www.transparenttextures.com/patterns/white-diamond.png');
            min-height: 100vh; 
            padding: clamp(1.25rem, 3vw, 2.5rem); 
            width: 100%;
            transition: all 0.3s ease;
        }
        
        /* Design des cartes événements */
        .wedding-card { 
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(10px);
            border-radius: 24px; 
            border: none; 
            transition: transform 0.3s, box-shadow 0.3s; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.02); 
        }
        
        .wedding-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 15px 35px rgba(197, 160, 89, 0.1);
        }
        
        .wedding-title { 
            font-family: 'Cormorant Garamond', serif; 
            font-size: clamp(1.4rem, 2.5vw, 1.9rem); 
            font-weight: 600; 
        }

        /* ==========================================================================
           Media Queries : Gestion de la Responsivité
           ========================================================================== */
        
        /* Version Grands Écrans / Ordinateurs de bureau */
        @media (min-width: 1200px) {
            .sidebar {
                display: flex !important;
                width: 250px;
            }
            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
            .mobile-navbar {
                display: none !important;
            }
        }

        /* Version Ordinateurs portables / Tablettes paysage */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .sidebar {
                display: flex !important;
                width: 220px;
            }
            .main-content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }
            .mobile-navbar {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="mobile-navbar">
        <div class="d-flex align-items-center">
            <img src="{{ asset('logo-removebg-preview.png') }}" height="35" style="filter: brightness(0) invert(1);" alt="Logo">
            <span class="ms-2 small text-uppercase fw-bold" style="color: var(--wed-gold); letter-spacing: 1px; font-size: 0.75rem;">Admin</span>
        </div>
        <button class="mobile-toggle-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="mobileSidebar" style="background-color: var(--wed-sidebar) !important; width: 280px;">
        <div class="offcanvas-header justify-content-end border-bottom border-secondary-subtle">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-4 d-flex flex-column">
            <div class="text-center mb-4">
                <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid px-4" style="filter: brightness(0) invert(1);" alt="Logo">
                <div class="mt-2 small text-uppercase" style="color: var(--wed-gold); letter-spacing: 2px; font-size: 0.75rem;">Excellence Admin</div>
            </div>
            
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-fill me-3"></i> Dashboard
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-heart-fill me-3"></i> Mariages
                </a>
                <a class="nav-link active" href="{{ route('admin.magazine.index') }}">
                    <i class="bi bi-book-half me-3"></i> Magazine Souvenir
                </a>
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle me-3"></i> Profil
                </a>
            </nav>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-12 sidebar p-4 d-flex flex-column">
                <div class="text-center mb-5">
                    <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid" style="filter: brightness(0) invert(1);" alt="Logo">
                    <div class="mt-3 small text-uppercase" style="color: var(--wed-gold); letter-spacing: 2px;">Excellence Admin</div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-fill me-3"></i> Dashboard</a>
                    <a class="nav-link" href="#"><i class="bi bi-heart-fill me-3"></i> Mariages</a>
                    <a class="nav-link active" href="{{ route('admin.magazine.index') }}"><i class="bi bi-book-half me-3"></i> Magazine Souvenir</a>
                    <a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-3"></i> Profil</a>
                </nav>
            </div>

            <div class="main-content">
                <div class="mb-4 mb-md-5">
                    <h2 class="fw-bold">Magazines Souvenirs</h2>
                    <p class="text-muted mb-0">Sélectionnez un événement pour consulter son Livre d'Or, voir ses messages et télécharger les photos.</p>
                </div>

                <div class="row g-4">
                    @forelse($weddings as $w)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card wedding-card h-100 p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge-date d-inline-block mb-2" style="background-color: rgba(197, 160, 89, 0.1); color: var(--wed-gold); padding: 6px 12px; border-radius: 8px; font-size: 0.85rem;">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $w->reception_date ? \Carbon\Carbon::parse($w->reception_date)->format('d/m/Y') : 'Non planifié' }}
                                    </span>
                                    <h3 class="wedding-title mt-2 mb-3">{{ $w->bride_name }} & {{ $w->groom_name }}</h3>
                                    <p class="text-muted small mb-0"><i class="bi bi-chat-left-heart me-2 text-danger"></i>{{ $w->invitations_count }} contribution(s) reçue(s)</p>
                                </div>
                                <div class="pt-3 border-top mt-4">
                                    <a href="{{ route('admin.magazine.show', $w->id) }}" class="btn btn-sm w-100 text-white rounded-3 py-2" style="background-color: var(--wed-dark); font-weight: 600;">
                                        Ouvrir le Livre d'Or <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                            <h4 class="fw-semibold">Aucun mariage enregistré pour le moment.</h4>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>