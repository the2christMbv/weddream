<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | WedDream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600&family=Cormorant+Garamond:ital,wght@0,600;1,600&display=swap');
        
        :root {
            --wed-gold: #c5a059;
            --wed-dark: #1e293b;
            --wed-bg: #f8fafc;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--wed-bg);
            color: var(--wed-dark);
            overflow-x: hidden;
        }

        /* Sidebar responsive */
        .sidebar { 
            background: var(--wed-dark);
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        @media (min-width: 992px) {
            .sidebar {
                position: fixed; 
                top: 0;
                left: 0;
                bottom: 0;
                width: 16.666667%;
                min-height: 100vh;
            }
            .main-content { 
                margin-left: 16.666667%; 
                width: 83.333333%;
            }
        }

        .nav-link {
            color: rgba(255,255,255,0.7);
            border-radius: 12px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #white !important;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            background: rgba(197, 160, 89, 0.15);
            color: var(--wed-gold) !important;
        }

        .main-content { 
            background: url('https://www.transparenttextures.com/patterns/white-diamond.png'); 
            min-height: 100vh;
        } 

        /* Carte Style Luxe */
        .card-profile { 
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 24px; 
            border: 1px solid rgba(255,255,255,1);
            box-shadow: 0 20px 40px rgba(0,0,0,0.04);
        }

        .title-wedding {
            font-family: 'Cormorant Garamond', serif;
            font-size: calc(1.8rem + 1vw);
            color: var(--wed-dark);
            letter-spacing: -1px;
        }

        .btn-gold { 
            background: var(--wed-gold); 
            border: none; 
            border-radius: 14px; 
            padding: 14px;
            color: white;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-gold:hover { 
            background: #af8d4a; 
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2);
            color: white;
        }

        .form-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin-bottom: 8px; }

        .input-group-custom {
            background: #f1f5f9;
            border-radius: 14px;
            border: 1px solid transparent;
            transition: 0.3s;
        }

        .input-group-custom:focus-within {
            border-color: var(--wed-gold);
            background: white;
            box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
        }

        .input-group-custom input {
            background: transparent;
            border: none;
            padding: 14px;
            box-shadow: none !important;
        }

        .input-group-custom .btn {
            border: none;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Barre supérieure pour Mobile & Tablette -->
        <header class="navbar navbar-dark sticky-top bg-dark d-lg-none p-3 shadow">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('logo-removebg-preview.png') }}" height="35" style="filter: brightness(0) invert(1);" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </header>

        <div class="row g-0">
            <!-- Sidebar (Ordinateur fixe / Mobile rétractable) -->
            <div class="col-lg-2 sidebar collapse d-lg-block p-4" id="sidebarMenu">
                <div class="text-center mb-5 d-none d-lg-block">
                    <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid" style="filter: brightness(0) invert(1);" alt="Logo">
                </div>
                <nav class="nav flex-column h-100">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-fill me-3"></i> Dashboard
                    </a>
                    <a class="nav-link active" href="{{ route('profile.edit') }}">
                        <i class="bi bi-shield-lock-fill me-3"></i> Sécurité
                    </a>
                    <div class="mt-4 mt-lg-auto pt-3 pb-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link text-white-50 text-decoration-none small p-0 w-100 text-start">
                                <i class="bi bi-box-arrow-left me-2"></i> Quitter la session
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <!-- Contenu Principal -->
            <div class="main-content p-3 p-md-5">
                <div class="row justify-content-center mt-lg-4">
                    <div class="col-100 col-md-10 col-lg-8 col-xl-6">
                        
                        <div class="text-center mb-4 mb-md-5">
                            <h1 class="title-wedding mb-2">Votre Sanctuaire</h1>
                            <p class="text-muted small">Gérez vos accès et sécurisez votre espace WedDream</p>
                        </div>

                        <div class="card-profile p-4 p-md-5">
                            @if(session('success'))
                                <div class="alert alert-success border-0 rounded-4 py-3 mb-4 text-center">
                                    <i class="bi bi-check2-circle me-2"></i> {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <!-- Mot de passe actuel -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Mot de passe actuel</label>
                                    <div class="input-group input-group-custom">
                                        <input type="password" name="current_password" id="current_pwd" class="form-control" placeholder="••••••••" required>
                                        <button type="button" class="btn" onclick="toggleVisibility('current_pwd', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                                </div>

                                <div class="row">
                                    <!-- Nouveau -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Nouveau mot de passe</label>
                                        <div class="input-group input-group-custom">
                                            <input type="password" name="new_password" id="new_pwd" class="form-control" placeholder="Min. 8 car." required>
                                            <button type="button" class="btn" onclick="toggleVisibility('new_pwd', this)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Confirmation -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Confirmation</label>
                                        <div class="input-group input-group-custom">
                                            <input type="password" name="new_password_confirmation" id="conf_pwd" class="form-control" placeholder="••••••••" required>
                                            <button type="button" class="btn" onclick="toggleVisibility('conf_pwd', this)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 mt-2 shadow-sm">
                                    Mettre à jour la sécurité
                                </button>
                                
                                <div class="text-center mt-4">
                                    <a href="{{ route('admin.dashboard') }}" class="text-muted small text-decoration-none">
                                        <i class="bi bi-arrow-left me-1"></i> Retour au tableau de bord
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script requis par Bootstrap pour le bouton Menu Burger (Mobile) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleVisibility(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = "password";
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>