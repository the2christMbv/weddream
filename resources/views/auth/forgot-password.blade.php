<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | WedDream</title>
    
    <!-- CDN Bootstrap 5 & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --text-main: #111111;
            --text-muted: #555555;
            --brand-dark: #2c3e50;
            --bg-solid-light: #f8f9fa;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
        }

        .login-container {
            min-height: 100vh;
        }

        /* SECTION GAUCHE : IDENTITÉ VISUELLE */
        .brand-section {
            background-image: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=1200');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #ffffff;
        }

        .brand-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(17, 17, 17, 0.5);
            z-index: 1;
        }

        .brand-content {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 500px;
        }

        .logo-img {
            height: 110px;
            width: auto;
            object-fit: contain;
            margin-bottom: 30px;
            filter: drop-shadow(0px 4px 10px rgba(0, 0, 0, 0.2));
        }

        .serif-title {
            font-family: 'Playfair Display', serif;
            font-weight: 400;
            font-size: 3rem;
            letter-spacing: 12px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .brand-message {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.4rem;
            letter-spacing: 2px;
            opacity: 0.95;
        }

        /* SECTION DROITE : FORMULAIRE */
        .form-section {
            background-color: var(--bg-solid-light);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
        }

        .form-card-white {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.03);
        }

        .form-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .form-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-group {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            border-color: var(--brand-dark);
            box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.08);
        }

        .form-control {
            border: none !important;
            padding: 14px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #000000 !important;
        }

        .form-control:focus {
            box-shadow: none !important;
        }

        .input-group-text {
            background: #ffffff;
            border: none;
            color: #888888;
            padding-left: 16px;
            padding-right: 16px;
        }

        .btn-login {
            background: var(--brand-dark);
            color: #ffffff;
            border-radius: 8px;
            padding: 14px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border: none;
            margin-top: 15px;
        }

        .btn-login:hover {
            background: #1a252f;
            transform: translateY(-2px);
            color: #ffffff;
            box-shadow: 0 8px 25px rgba(44, 62, 80, 0.15);
        }

        .back-link {
            font-size: 0.8rem;
            color: var(--text-muted);
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--text-main);
        }

        .brand-section, .form-section {
            min-height: 100vh;
        }

        @media (max-width: 991.98px) {
            .brand-section { min-height: 35vh; padding: 40px 20px; }
            .serif-title { font-size: 2.2rem; }
            .brand-message { font-size: 1.1rem; }
            .form-section { min-height: 65vh; padding: 30px 15px; }
            .form-card-white { padding: 35px 25px; box-shadow: none; border: none; background: transparent; }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 login-container">
        
        <!-- COLONNE GAUCHE (CONSERVÉE) -->
        <div class="col-lg-6 brand-section">
            <div class="brand-content">
                <img src="{{ asset('logo-removebg-preview.png') }}" alt="WedDream Logo" class="logo-img">
                <h1 class="serif-title">WedDream</h1>
                <p class="brand-message">L'art d'orchestrer vos plus beaux événements.</p>
            </div>
        </div>

        <!-- COLONNE DROITE : LOGIQUE DE RÉCUPÉRATION -->
        <div class="col-lg-6 form-section">
            <div class="form-card-white">
                
                <div class="mb-4">
                    <h2 class="form-header-title">Récupération</h2>
                    <p class="text-muted small">Saisissez votre email. Un lien de réinitialisation vous sera envoyé.</p>
                </div>

                <!-- Notification de succès Laravel (Lien envoyé) -->
                @if (session('status'))
                    <div class="alert alert-success py-2.5 px-3 border-0 rounded-3 small mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                    </div>
                @endif

                <!-- Gestion des erreurs -->
                @if($errors->any())
                    <div class="alert alert-danger py-2.5 px-3 border-0 rounded-3 small mb-4">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Adresse Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" 
                                   placeholder="nom@exemple.com" required value="{{ old('email') }}" autofocus>
                        </div>
                    </div>

                    <!-- Bouton d'action -->
                    <button type="submit" class="btn btn-login w-100 mb-3">
                        Envoyer le lien
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none back-link">
                            <i class="bi bi-arrow-left me-1"></i> Retour à la connexion
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>