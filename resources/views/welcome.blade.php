<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream — Système de Gestion Privé</title>
    
    <!-- CDN Bootstrap 5 & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.90);
            --glass-border: rgba(255, 255, 255, 0.6);
            --text-main: #111111;
            --text-muted: #555555;
            --line-fine: rgba(0, 0, 0, 0.08);
        }

        body, html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            
            background-image: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=1920');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .page-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 1;
            background: rgba(255, 255, 255, 0.75); 
            pointer-events: none;
        }

        .main-wrapper {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* EN-TÊTE AJUSTÉ AVEC LOGO PLUS GRAND */
        .app-header {
            padding: 40px 0 20px 0;
            border-bottom: 1px solid var(--text-main);
            max-width: 85%;
            margin: 0 auto;
            width: 100%;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 35px;
            flex-wrap: wrap;
        }

        .brand-logo-img {
            height: 95px; /* Augmentation notable de la taille du logo */
            width: auto;
            object-fit: contain;
            transition: height 0.3s ease;
        }

        .header-text-block {
            text-align: left;
        }

        .brand-title {
            font-family: 'Playfair Display', serif;
            font-weight: 400;
            font-size: 2.8rem;
            letter-spacing: 12px;
            text-transform: uppercase;
            color: var(--text-main);
            margin: 0;
            line-height: 1.1;
        }

        .brand-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.1rem;
            font-weight: 400;
            letter-spacing: 3px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* GRILLE STRICTEMENT RESPONSIVE POUR TOUS LES ÉCRANS */
        .modules-grid {
            max-width: 85%;
            margin: auto;
            width: 100%;
        }

        /* CARTES : Largeur maîtrisée, longueur augmentée (élancement vertical) */
        .monolith-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            height: 100%;
            min-height: 480px; /* Force l'allongement vertical des cartes */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.03);
        }

        /* Bannière photo haute et élancée */
        .card-banner-wrapper {
            position: relative;
            height: 180px; /* Augmentation de la hauteur de la zone photo */
            width: 100%;
            overflow: hidden;
            border-bottom: 1px solid var(--line-fine);
            background-color: #f5f5f5;
        }

        .card-banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(10%) brightness(95%);
            transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-body-content {
            padding: 35px 30px; /* Plus d'espace pour étirer la structure */
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-index {
            font-family: 'Playfair Display', serif;
            font-size: 0.7rem;
            color: var(--text-muted);
            letter-spacing: 3px;
            margin-bottom: 12px;
            display: block;
        }

        .card-title-clean {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 15px;
            color: var(--text-main);
        }

        .card-desc-clean {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.8;
            font-weight: 400;
            margin-bottom: 25px;
        }

        .btn-clean {
            display: block;
            width: 100%;
            padding: 14px 0;
            text-align: center;
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--text-main);
            border: 1px solid var(--text-main);
            background: transparent;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            margin-top: auto;
        }

        /* Hover */
        .monolith-card:hover {
            border-color: var(--text-main);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.06);
            transform: translateY(-5px);
            background: #ffffff;
        }

        .monolith-card:hover .card-banner-img {
            filter: grayscale(0%) brightness(100%);
            transform: scale(1.04);
        }

        .monolith-card:hover .btn-clean {
            background-color: var(--text-main);
            color: #ffffff;
        }

        .footer-clean {
            padding: 40px 0;
            font-family: 'Playfair Display', serif;
            font-size: 0.7rem;
            letter-spacing: 6px;
            color: var(--text-muted);
            text-transform: uppercase;
            border-top: 1px solid var(--text-main);
            max-width: 85%;
            margin: 0 auto;
            width: 100%;
        }

        /* DESKTOP, TABLETTE ET MOBILE : ADAPTATION LOGIQUE ET FLUIDE */
        @media (max-width: 1200px) {
            /* Tablettes et petits écrans d'ordinateurs */
            .brand-logo-img { height: 80px; }
            .brand-title { font-size: 2.2rem; }
        }

        @media (max-width: 768px) {
            /* Mobiles et liseuses */
            .header-container {
                text-align: center;
                flex-direction: column;
                gap: 15px;
            }
            .header-text-block {
                text-align: center;
            }
            .brand-logo-img {
                height: 75px;
            }
            .brand-title {
                font-size: 1.8rem;
                letter-spacing: 6px;
            }
            .modules-grid {
                max-width: 90%;
            }
            .monolith-card {
                min-height: auto; /* Laisse le contenu respirer sans forcer sur mobile */
            }
        }
    </style>
</head>
<body>

    <div class="page-overlay"></div>

    <div class="main-wrapper">
        
        <!-- EN-TÊTE AVEC LOGO AGRANDI -->
        <header class="app-header">
            <div class="header-container">
                <img src="/logo-removebg-preview.png" alt="WedDream Logo" class="brand-logo-img">
                <div class="header-text-block">
                    <h1 class="brand-title">WedDream</h1>
                    <div class="brand-subtitle">Système de Gestion Privé</div>
                </div>
            </div>
        </header>

        <!-- GRILLE ADAPTATIVE : 4 colonnes sur très grand écran, 2 sur tablette, 1 sur mobile -->
        <main class="modules-grid row g-4 py-5">
            
            <!-- Module I -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="monolith-card">
                    <div class="card-banner-wrapper">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600" class="card-banner-img" alt="Superviseur">
                    </div>
                    <div class="card-body-content">
                        <span class="card-index">I / MONITORING</span>
                        <h2 class="card-title-clean">Superviseur</h2>
                        <p class="card-desc-clean">
                            Pilotage central de l'événement. Supervision des salons d'honneur, validation des plans de table et coordination protocolaire globale.
                        </p>
                        <a href="/login" class="btn-clean">Entrer</a>
                    </div>
                </div>
            </div>

            <!-- Module II -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="monolith-card">
                    <div class="card-banner-wrapper">
                        <img src="https://images.unsplash.com/photo-1513151233558-d860c5398176?q=80&w=600" class="card-banner-img" alt="Équipe Service">
                    </div>
                    <div class="card-body-content">
                        <span class="card-index">II / CATERING</span>
                        <h2 class="card-title-clean">Équipe Service</h2>
                        <p class="card-desc-clean">
                            Orchestration des banquets. Suivi des commandes du bar d'honneur, gestion des caves de prestige et fluidité du service en temps réel.
                        </p>
                        <a href="/login" class="btn-clean">Entrer</a>
                    </div>
                </div>
            </div>

            <!-- Module III -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="monolith-card">
                    <div class="card-banner-wrapper">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=600" class="card-banner-img" alt="Check-in">
                    </div>
                    <div class="card-body-content">
                        <span class="card-index">III / IDENTIFICATION</span>
                        <h2 class="card-title-clean">Check-in & Scan</h2>
                        <p class="card-desc-clean">
                            Contrôle d'accès d'apparat. Numérisation des invitations, validation des codes d'accès uniques et orientation instantanée des convives.
                        </p>
                        <a href="/login" class="btn-clean">Entrer</a>
                    </div>
                </div>
            </div>

            <!-- Module IV -->
            <!-- Module IV -->
<div class="col-xl-3 col-md-6 col-12">
    <div class="monolith-card">
        <div class="card-banner-wrapper">
            <img src="https://images.unsplash.com/photo-1614036417651-efe5912149d8?q=80&w=600" class="card-banner-img" alt="Impression Invitations">
        </div>
        <div class="card-body-content">
            <span class="card-index">IV / PRINTING</span>
            <h2 class="card-title-clean">Invitations Papier</h2>
            <p class="card-desc-clean">
                Gestion de la papeterie physique. Suivi des impressions de prestige, processus de gaufrage, dorures personnalisées et logistique de distribution des faire-part officiels.
            </p>
            <a href="/login" class="btn-clean">Entrer</a>
        </div>
    </div>
</div>
        </main>

        <!-- PIED DE PAGE -->
        <!-- PIED DE PAGE -->
<footer class="footer-clean text-center">
    WedDream &bull; Un produit de Yetoo Technologie KC &bull; MMXXVI
</footer>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>