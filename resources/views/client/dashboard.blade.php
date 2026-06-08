<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Tableau de Bord Royal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        :root {
            --gold-gradient: linear-gradient(135deg, #c5a059 0%, #f1d299 50%, #c5a059 100%);
            --royal-blue: #1e293b;
            --soft-cream: #fdfbf7;
            --glass: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--soft-cream);
            color: var(--royal-blue);
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .hero-luxe {
            background: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), 
                        url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: clamp(40px, 6vw, 80px) 20px clamp(80px, 10vw, 130px) 20px;
            clip-path: ellipse(150% 100% at 50% 0%);
            text-align: center;
            color: white;
            position: relative;
        }

        /* Bouton Déconnexion Premium */
        .logout-wrapper {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.9);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-logout:hover {
            background: rgba(220, 53, 69, 0.2);
            border-color: rgba(220, 53, 69, 0.4);
            color: #ff8585;
            transform: translateY(-2px);
        }

        .couple-names {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 4rem);
            margin-bottom: 1rem;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            line-height: 1.2;
        }

        .hero-luxe p {
            font-size: clamp(0.9rem, 1.8vw, 1.2rem);
            max-width: 600px;
            margin: 0 auto;
        }

        /* ==========================================================================
           Cards Actions
           ========================================================================== */
        .action-card {
            border: none;
            border-radius: 24px;
            background: white;
            padding: clamp(20px, 3vw, 30px);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(197, 160, 89, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media (min-width: 992px) {
            .action-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(197, 160, 89, 0.15);
                border-color: #c5a059;
            }
        }

        .icon-circle {
            width: clamp(55px, 8vw, 70px);
            height: clamp(55px, 8vw, 70px);
            background: var(--soft-cream);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: clamp(1.3rem, 2.5vw, 1.7rem);
            color: #c5a059;
            transition: 0.3s;
            flex-shrink: 0;
        }

        .action-card:hover .icon-circle {
            background: var(--gold-gradient);
            color: white;
        }

        .action-card h5 {
            font-size: clamp(1.1rem, 1.8vw, 1.25rem);
            margin-bottom: 10px;
        }

        .action-card p {
            font-size: clamp(0.85rem, 1.4vw, 0.95rem);
            margin-bottom: 20px;
        }

        .btn-gold {
            background: var(--gold-gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px clamp(15px, 2.5vw, 25px);
            border-radius: 50px;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(197, 160, 89, 0.25);
            font-size: clamp(0.85rem, 1.4vw, 0.9rem);
            display: inline-block;
            text-decoration: none;
        }

        .btn-gold:hover {
            transform: scale(1.02);
            color: white;
            box-shadow: 0 6px 20px rgba(197, 160, 89, 0.35);
        }

        .card-featured {
            border: 1px solid #c5a059 !important;
        }
        
        .card-featured .icon-circle {
            background-color: rgba(197, 160, 89, 0.1);
        }

        /* ==========================================================================
           Section Title & Header
           ========================================================================== */
        .section-header {
            text-align: center;
            margin-top: -40px; 
            margin-bottom: 35px;
            padding: 0 15px;
            position: relative;
            z-index: 5;
        }

        .header-pill {
            display: inline-flex;
            align-items: center;
            padding: 10px clamp(20px, 3vw, 30px);
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            border: none;
            background: white;
        }

        .header-pill h4 {
            font-size: clamp(1rem, 2.2vw, 1.35rem);
            margin-bottom: 0;
            font-weight: 700;
        }

        .badge-premium {
            background: var(--gold-gradient);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: clamp(0.65rem, 1.3vw, 0.75rem);
            text-transform: uppercase;
            display: inline-block;
        }

        /* ==========================================================================
           Bloc de Statistiques Grid Réactif
           ========================================================================== */
        .stat-grid-container {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            border: 1px solid rgba(0, 0, 0, 0.03);
            padding: 10px;
        }

        .stat-item {
            text-align: center;
            padding: 15px 5px;
            height: 100%;
        }

        .stat-item h3 {
            font-size: clamp(1.4rem, 2.5vw, 2rem);
        }

        /* Gestion intelligente des lignes de séparation selon l'écran */
        .border-r-md { border-right: 1px solid #e2e8f0; }
        .border-b-sm { border-bottom: none; }

        @media (max-width: 767.98px) {
            .border-r-md { border-right: none; }
            .border-sm-custom:nth-child(odd) { border-right: 1px solid #e2e8f0; }
            .border-sm-custom:nth-child(1), .border-sm-custom:nth-child(2) { border-bottom: 1px solid #e2e8f0; }
            
            .logout-wrapper {
                position: relative;
                top: 0;
                right: 0;
                margin-bottom: 15px;
                text-align: right;
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .hero-luxe {
                clip-path: ellipse(200% 100% at 50% 0%);
                padding-top: 30px;
                padding-bottom: 75px;
            }
            .section-header {
                margin-top: -30px;
                margin-bottom: 25px;
            }
        }
    </style>
</head>
<body>

    <section class="hero-luxe">
        <!-- Bouton Déconnexion -->
        <div class="logout-wrapper container text-end">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-logout shadow-sm">
                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                </button>
            </form>
        </div>

        <div class="container">
            <span class="badge-premium mb-3">Espace Client Exclusif</span>
            <h1 class="couple-names">
                {{ explode(' ', $wedding->groom_name)[0] }} & {{ explode(' ', $wedding->bride_name)[0] }}
            </h1>
            <p class="lead fw-light">L'excellence pour votre union à {{ $wedding->reception_location ?? 'votre lieu d\'exception' }}</p>
        </div>
    </section>

    <main class="container my-5"> 
        
        <div class="section-header">
            <div class="header-pill">
                <h4 class="fw-bold"><i class="bi bi-stars text-warning me-2"></i>Vos Actions Prioritaires</h4>
            </div>
        </div>

        <!-- Grille des actions principales -->
        <div class="row g-4 justify-content-center">
            
            <!-- Carte 1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="action-card">
                    <div>
                        <div class="icon-circle">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold">Superviseurs</h5>
                        <p class="text-muted">Désignez les anges gardiens qui scanneront les invitations le jour J.</p>
                    </div>
                    <a href="{{ route('client.staff.index') }}" class="btn btn-gold w-100">
                        Nommer mon équipe
                    </a>
                </div>
            </div>

            <!-- Carte 2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="action-card">
                    <div>
                        <div class="icon-circle">
                            <i class="bi bi-send-fill"></i>
                        </div>
                        <h5 class="fw-bold">Envoyer les Liens Et Impression</h5>
                        <p class="text-muted">Partagez l'invitation magique à vos invités via WhatsApp ou Email et vos impressions .</p>
                    </div>
                    <a href="{{ route('invitations.index') }}" class="btn btn-gold w-100">Gérer les envois</a>
                </div>
            </div>

            <!-- Carte 3 -->
            

            <!-- Carte 4 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="action-card card-featured">
                    <div>
                        <div class="icon-circle">
                            <i class="bi bi-image-fill"></i>
                        </div>
                        <h5 class="fw-bold">Photo de Couverture</h5>
                        <p class="text-muted">Ajoutez la photo officielle du couple qui s'affichera en fond d'écran de vos invitations en ligne.</p>
                    </div>
                    <a href="{{ route('client.invitation.selection-modeles') }}" class="btn btn-gold w-100">
                        <i class="bi bi-camera me-2"></i>Choisir la photo
                    </a>
                </div>
            </div>

            <!-- Carte 5 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="action-card">
                    <div>
                        <div class="icon-circle" style="background: #fff9e6; color: #d4af37;">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h5 class="fw-bold">Programme Officiel</h5>
                        <p class="text-muted">Gérez les horaires et lieux du mariage coutumier, civil, religieux et de la soirée.</p>
                    </div>
                    <a href="{{ route('wedding.program.index', $wedding->id) }}" class="btn btn-outline-dark w-100 rounded-pill py-2 fw-semibold" style="font-size: 0.9rem;">
                        Configurer <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Carte 6 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="action-card bg-dark text-white">
                    <div>
                        <div class="icon-circle bg-secondary">
                            <i class="bi bi-headset text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white">Besoin d'aide ?</h5>
                        <p class="text-light opacity-75">Votre planificateur WedDream est disponible 24h/24 pour vous accompagner.</p>
                    </div>
                    <a href="https://wa.me/243844994408" class="btn btn-success rounded-pill w-100 py-2 fw-semibold" style="font-size: 0.9rem;">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                </div>
            </div>

        </div>

        <!-- Section Statistiques Réactive -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="stat-grid-container">
                    <div class="row g-0">
                        
                        <!-- Stat 1 -->
                        <div class="col-6 col-md-3 border-sm-custom border-r-md">
                            <div class="stat-item">
                                <div class="text-muted mb-1"><i class="bi bi-people fs-4"></i></div>
                                <h3 class="fw-bold mb-0 text-dark">
                                    {{ $wedding->invitations->sum('access_count') }}
                                </h3>
                                <div class="text-uppercase tracking-wider fw-semibold text-muted mt-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Invités attendus</div>
                            </div>
                        </div>
                        
                        <!-- Stat 2 -->
                        <div class="col-6 col-md-3 border-sm-custom border-r-md">
                            <div class="stat-item">
                                <div class="text-success mb-1"><i class="bi bi-check-circle-fill fs-4"></i></div>
                                <h3 class="fw-bold mb-0 text-success">
                                    {{ $wedding->invitations->where('rsvp_status', 'confirme')->sum('access_count') }}
                                </h3>
                                <div class="text-uppercase tracking-wider fw-semibold text-muted mt-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Confirmés</div>
                            </div>
                        </div>
                        
                        <!-- Stat 3 -->
                        <div class="col-6 col-md-3 border-sm-custom border-r-md">
                            <div class="stat-item">
                                <div class="text-danger mb-1"><i class="bi bi-x-circle-fill fs-4"></i></div>
                                <h3 class="fw-bold mb-0 text-danger">
                                    {{ $wedding->invitations->where('rsvp_status', 'decline')->sum('access_count') }}
                                </h3>
                                <div class="text-uppercase tracking-wider fw-semibold text-muted mt-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Déclinés</div>
                            </div>
                        </div>
                        
                        <!-- Stat 4 -->
                        <div class="col-6 col-md-3 border-sm-custom">
                            <div class="stat-item">
                                <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                <h3 class="fw-bold mb-0 text-dark">
                                    @php
                                        $daysLeft = null;
                                        $firstProgramDate = $wedding->programs()
                                            ->whereNotNull('event_date')
                                            ->where('event_date', '!=', '')
                                            ->orderBy('event_date', 'asc')
                                            ->value('event_date');

                                        $targetDateStr = $firstProgramDate ?: $wedding->reception_date;

                                        if (!empty($targetDateStr)) {
                                            try {
                                                $dateOnly = explode(' ', $targetDateStr)[0];
                                                $targetDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dateOnly)->startOfDay();
                                                $today = \Carbon\Carbon::today();
                                                $daysLeft = $today->diffInDays($targetDate, false);
                                            } catch (\Exception $e) {
                                                $daysLeft = null;
                                            }
                                        }
                                    @endphp
                                    
                                    @if($daysLeft !== null)
                                        @if($daysLeft > 0)
                                            J-{{ $daysLeft }}
                                        @elseif($daysLeft == 0)
                                            <span class="text-warning fw-bold" style="font-size: clamp(1.1rem, 2vw, 1.4rem);">Jour J ✨</span>
                                        @else
                                            <span class="text-muted" style="font-size: clamp(1.1rem, 2vw, 1.4rem);">Passé</span>
                                        @endif
                                    @else
                                        <span class="text-muted small italic" style="font-size: clamp(0.9rem, 1.8vw, 1.1rem);">À définir</span>
                                    @endif
                                </h3>
                                <div class="text-uppercase tracking-wider fw-semibold text-muted mt-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Compte à rebours</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center py-4 mt-auto">
        <p class="text-muted small">&copy; 2026 <strong>WedDream Prestige</strong> - Kinshasa & Matadi</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>