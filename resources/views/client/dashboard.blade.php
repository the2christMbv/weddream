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
        }

        /* Hero Luxe */
        .hero-luxe {
            background: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), 
                        url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: 100px 0 150px 0;
            clip-path: ellipse(150% 100% at 50% 0%);
            text-align: center;
            color: white;
        }

        .couple-names {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        /* Cards Actions */
        .action-card {
            border: none;
            border-radius: 30px;
            background: white;
            padding: 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(197, 160, 89, 0.1);
        }

        .action-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(197, 160, 89, 0.15);
            border-color: #c5a059;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: var(--soft-cream);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: #c5a059;
            transition: 0.3s;
        }

        .action-card:hover .icon-circle {
            background: var(--gold-gradient);
            color: white;
        }

        .btn-gold {
            background: var(--gold-gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(197, 160, 89, 0.3);
        }

        .btn-gold:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 6px 20px rgba(197, 160, 89, 0.4);
        }

        /* Section Title */
        .section-header {
            text-align: center;
            margin-top: -80px;
            margin-bottom: 60px;
        }

        .badge-premium {
            background: var(--gold-gradient);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

    </style>
</head>
<body>

    <section class="hero-luxe">
        <div class="container">
            <span class="badge-premium mb-3">Espace Client Exclusif</span>
            <h1 class="couple-names">
                {{ explode(' ', $wedding->groom_name)[0] }} & {{ explode(' ', $wedding->bride_name)[0] }}
            </h1>
            <p class="lead fw-light">L'excellence pour votre union à {{ $wedding->reception_location ?? 'votre lieu d\'exception' }}</p>
        </div>
    </section>

    <main class="container mb-5">
        
        <div class="section-header">
            <div class="card d-inline-block p-3 rounded-pill shadow-lg border-0 bg-white">
                <h4 class="mb-0 px-4 fw-bold"> <i class="bi bi-stars text-warning"></i> Vos Actions Prioritaires</h4>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            
            <div class="col-md-6 col-lg-4">
                <div class="action-card">
                    <div class="icon-circle">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold">Superviseurs</h5>
                    <p class="text-muted small">Désignez les anges gardiens qui scanneront les invitations le jour J.</p>
                    <a href="{{ route('client.staff.index') }}" class="btn btn-gold w-100">
                        Nommer mon équipe
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="action-card">
                    <div class="icon-circle">
                        <i class="bi bi-send-fill"></i>
                    </div>
                    <h5 class="fw-bold">Envoyer les Liens</h5>
                    <p class="text-muted small">Partagez l'invitation magique à vos invités via WhatsApp ou Email.</p>
                    <a href="{{ route('invitations.index') }}" class="btn btn-gold w-100">Gérer les envois</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="action-card">
                    <div class="icon-circle">
                        <i class="bi bi-printer"></i>
                    </div>
                    <h5 class="fw-bold">Cartes Physiques</h5>
                    <p class="text-muted small">Générez des PDF élégants pour vos invités sans smartphone.</p>
                    <button class="btn btn-gold w-100">Imprimer les cartes</button>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
    <div class="action-card h-100 p-4 shadow-sm text-center" style="background: white; border-radius: 25px; border: 1px solid #c5a059 !important;">
        <div class="icon-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(197, 160, 89, 0.1); border-radius: 50%; color: #c5a059;">
            <i class="bi bi-image-fill fs-3"></i>
        </div>
        
        <h5 class="fw-bold mb-3">Photo de Couverture</h5>
        
        <p class="text-muted small mb-4">
            Ajoutez la photo officielle du couple qui s'affichera en **fond d'écran de vos invitations en ligne**.
        </p>
        
        <div class="d-grid gap-2">
            <a href="{{ route('client.invitation.selection-modeles') }}" class="btn btn-gold w-100 py-2 shadow-sm" style="background-color: #c5a059; color: white; border: none; border-radius: 50px; font-weight: 600;">
               <i class="bi bi-camera me-2"></i> Choisir la photo
            </a>
        </div>
    </div>
</div>

            <div class="col-md-6 col-lg-4">
                <div class="action-card">
                    <div class="icon-circle" style="background: #fff9e6; color: #d4af37;">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h5 class="fw-bold">Programme Officiel</h5>
                    <p class="small text-muted">Gérez les horaires et lieux du mariage coutumier, civil, religieux et de la soirée.</p>
                    <a href="{{ route('wedding.program.index', $wedding->id) }}" class="btn btn-outline-dark w-100 rounded-pill">
                        Configurer <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="action-card bg-dark text-white">
                    <div class="icon-circle bg-secondary">
                        <i class="bi bi-headset text-white"></i>
                    </div>
                    <h5 class="fw-bold">Besoin d'aide ?</h5>
                    <p class="text-light opacity-75 small">Votre planificateur WedDream est disponible 24h/24.</p>
                    <a href="https://wa.me/243844994408" class="btn btn-success rounded-pill w-100">
                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12 mb-4">
                <div class="p-4 rounded-4 bg-white shadow-sm d-flex justify-content-around align-items-center flex-wrap" style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9) !important;">
                    
                    <div class="text-center p-3">
                        <div class="text-muted mb-1"><i class="bi bi-people fs-4"></i></div>
                        <h3 class="fw-bold mb-0 text-dark">
                            {{ $wedding->invitations->sum('access_count') }}
                        </h3>
                        <small class="text-uppercase tracking-wider fw-semibold text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">Invités attendus</small>
                    </div>
                    
                    <div style="width: 1px; height: 50px; background: #e2e8f0" class="d-none d-md-block"></div>
                    
                    <div class="text-center p-3">
                        <div class="text-success mb-1"><i class="bi bi-check-circle-fill fs-4"></i></div>
                        <h3 class="fw-bold mb-0 text-success">
                            {{ $wedding->invitations->where('rsvp_status', 'confirme')->sum('access_count') }}
                        </h3>
                        <small class="text-uppercase tracking-wider fw-semibold text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">Confirmés</small>
                    </div>
                    
                    <div style="width: 1px; height: 50px; background: #e2e8f0" class="d-none d-md-block"></div>

                    <div class="text-center p-3">
                        <div class="text-danger mb-1"><i class="bi bi-x-circle-fill fs-4"></i></div>
                        <h3 class="fw-bold mb-0 text-danger">
                            {{ $wedding->invitations->where('rsvp_status', 'decline')->sum('access_count') }}
                        </h3>
                        <small class="text-uppercase tracking-wider fw-semibold text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">Déclinés</small>
                    </div>
                    
                    <div style="width: 1px; height: 50px; background: #e2e8f0" class="d-none d-md-block"></div>
                    
                    <div class="text-center p-3">
                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                        <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.8rem;">
                            @php
                                $daysLeft = null;
                                
                                // Étape 1 : On cherche la date la plus proche parmi le programme enregistré
                                $firstProgramDate = $wedding->programs()
                                    ->whereNotNull('event_date')
                                    ->where('event_date', '!=', '')
                                    ->orderBy('event_date', 'asc')
                                    ->value('event_date');

                                // Étape 2 : Si vide, on se rabat sur la colonne reception_date de la table wedding
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
                                    <span class="text-warning fw-bold">Jour J ✨</span>
                                @else
                                    <span class="text-muted fs-5">Passé</span>
                                @endif
                            @else
                                <span class="text-muted fs-6" style="font-style: italic;">À définir</span>
                            @endif
                        </h3>
                        <small class="text-uppercase tracking-wider fw-semibold text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">Compte à rebours</small>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center py-5">
        <p class="text-muted small">&copy; 2026 <strong>WedDream Prestige</strong> - Kinshasa & Matadi</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>