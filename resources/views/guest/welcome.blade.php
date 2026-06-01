@php
    $photoPath = $wedding->cover_photo;
    $cleanPath = ltrim($photoPath, '/');
    $finalUrl = asset('storage/' . $cleanPath);
    
    $groom = explode(' ', $wedding->groom_name)[0];
    $bride = explode(' ', $wedding->bride_name)[0];
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Royale | {{ $groom }} & {{ $bride }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,900;1,400&family=Montserrat:wght@100;300;600&display=swap');

        :root {
            --gold: #c5a059;
            --dark-royal: #0f172a;
            --cream: #fdfbf7;
        }

        body {
            /* CONSERVATION DE L'ARRIÈRE-PLAN DEMANDÉ */
            background: linear-gradient(rgba(40, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), 
                        url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Pour un effet de scroll plus sympa */
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-wrapper {
            max-width: 600px; /* Légèrement élargi pour accueillir les cards */
            margin: 0 auto;
            min-height: 100vh;
            color: var(--dark-royal);
            position: relative;
            overflow: hidden;
            padding-bottom: 50px;
        }

        /* SECTION HERO AVEC LA PHOTO DU COUPLE */
        .hero-section {
            position: relative;
            height: 75vh; /* Hauteur ajustée pour laisser voir les cards en bas */
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            border-radius: 50px 50px 50px 50px; /* Coins arrondis pour le style iParty */
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .hero-image {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('{{ $finalUrl }}') no-repeat center center;
            background-size: cover;
            z-index: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, transparent 50%, rgba(15,23,42,0.8) 100%);
            z-index: 2;
        }

        .hero-title {
            position: relative;
            z-index: 3;
            text-align: center;
            padding-bottom: 40px;
            color: white;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .hero-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 900;
            margin: 0;
        }

        /* STYLE DES CARDS (INVITATION ET PROGRAMME) */
        .info-card {
            background: white;
            margin: -50px 20px 30px 20px; /* Chevauchement sur le hero */
            padding: 40px 25px;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            position: relative;
            z-index: 10;
            border: 1px solid rgba(197, 160, 89, 0.2);
            text-align: center;
        }

        /* MOTIF ROYAL EN LOSANGE DANS LES CARDS */
        .info-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='100' viewBox='0 0 60 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0 L60 50 L30 100 L0 50 Z' fill='none' stroke='%23c5a059' stroke-width='0.5' stroke-opacity='0.1'/%3E%3C/svg%3E");
            z-index: -1;
            border-radius: 30px;
            pointer-events: none;
        }

        .card-label {
            font-family: 'Cinzel Decorative', serif;
            color: var(--gold);
            letter-spacing: 3px;
            font-size: 0.7rem;
            text-transform: uppercase;
            margin-bottom: 15px;
            display: block;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--dark-royal);
        }

        /* TIMELINE DU PROGRAMME DANS LA CARD */
        .timeline {
            position: relative;
            padding-left: 20px;
            text-align: left;
            margin-top: 30px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            border-left: 2px solid rgba(197, 160, 89, 0.3);
            padding-left: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 5px;
            width: 14px;
            height: 14px;
            background: var(--gold);
            transform: rotate(45deg);
            z-index: 2;
        }

        .event-time {
            font-weight: 700;
            color: var(--gold);
            font-size: 0.8rem;
            display: block;
        }

        .event-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 5px 0;
            color: var(--dark-royal);
        }

        .event-details {
            font-size: 0.75rem;
            opacity: 0.7;
            line-height: 1.6;
        }

        /* BOUTON RSVP */
        .btn-rsvp {
            background: var(--dark-royal);
            color: white;
            text-align: center;
            padding: 18px;
            width: 100%;
            display: block;
            text-decoration: none;
            letter-spacing: 3px;
            font-weight: 600;
            font-size: 0.8rem;
            border-radius: 15px;
            transition: 0.4s;
            margin-top: 30px;
            box-shadow: 0 10px 20px rgba(15,23,42,0.2);
            box-sizing: border-box; /* Évite que le padding ne fasse déborder le bouton à 100% */
        }

        .btn-rsvp:hover {
            background: var(--gold);
            color: white;
            transform: translateY(-3px);
        }

        /* ==========================================================================
           COUCHE RESPONSIVE AJOUTÉE (SANS DOULONS NI MODIFICATIONS DE TES BASES)
           ========================================================================== */

        /* 💻 ORDINATEURS & GRANDS ÉCRANS */
        @media screen and (min-width: 1025px) {
            body {
                padding-top: 30px;
                padding-bottom: 30px;
            }
            .main-wrapper {
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
                border-radius: 40px;
                background-color: rgba(255, 255, 255, 0.02);
                backdrop-filter: blur(5px);
            }
            .hero-section {
                border-radius: 40px 40px 0 0; /* Épouse le haut du wrapper sur PC */
            }
        }

        /* 📋 TABLETTES (De 768px à 1024px) */
        @media screen and (max-width: 1024px) and (min-width: 768px) {
            .main-wrapper {
                max-width: 80%; /* S'étend un peu plus pour un confort de lecture optimal */
            }
            .hero-section {
                height: 65vh; /* Hauteur ajustée pour un meilleur ratio sur tablette */
            }
            .info-card {
                padding: 45px 35px; /* Plus d'espace intérieur */
            }
        }

        /* 📱 SMARTPHONES (Moins de 768px) */
        @media screen and (max-width: 767px) {
            .main-wrapper {
                width: 100%;
                max-width: 100%;
                padding-bottom: 30px;
            }
            .hero-section {
                height: 60vh; /* Réduit la hauteur pour afficher le début de la card directement */
                border-radius: 0 0 40px 40px; /* Arrondi uniquement le bas pour le style mobile immersif */
            }
            .hero-title h1 {
                font-size: 2.4rem; /* Évite que les longs prénoms ne se coupent agressivement */
            }
            .info-card {
                margin: -40px 15px 25px 15px; /* Marges réduites pour gagner de la place */
                padding: 30px 18px;
                border-radius: 24px;
            }
            .card-title {
                font-size: 1.6rem;
                margin-bottom: 15px;
            }
            .timeline {
                padding-left: 10px;
            }
            .event-title {
                font-size: 1.1rem;
            }
            .btn-rsvp {
                padding: 15px;
                font-size: 0.75rem;
            }
        }

        /* 📳 PETITS ÉCRANS MOBILES (Moins de 380px - ex: iPhone SE) */
        @media screen and (max-width: 375px) {
            .hero-title h1 {
                font-size: 2rem;
            }
            .info-card {
                padding: 25px 12px;
            }
            .card-title {
                font-size: 1.4rem;
            }
        }
</style>
</head>
<body> 

    <div class="main-wrapper"> 
        
        <div class="hero-section">
            <div class="hero-image" id="parallax"></div>
            <div class="hero-overlay"></div>
            <div class="hero-title" data-aos="fade-up">
                <h1>{{ $groom }}</h1>
                <div style="font-family: 'Cinzel Decorative'; color: var(--gold); font-size: 1.8rem; margin: 5px 0;">&</div>
                <h1>{{ $bride }}</h1>
            </div>
        </div> <br>

        <div class="info-card" data-aos="fade-up" data-aos-delay="100">
            <span class="card-label">Invitation Spéciale</span>
            <h2 class="card-title">Cher(e) {{ $invitation->guest_name }}</h2>
            
            <p style="font-size: 0.95rem; line-height: 1.8; color: #555; font-weight: 300; margin-bottom: 0;">
                C'est avec une immense joie que nous vous invitons à célébrer l'union de nos vies. Votre présence témoignera de l'affection que nous vous portons et rendra ce moment inoubliable. Nous avons hâte de partager ce chapitre de notre histoire avec vous.
            </p>
        </div>

        <div class="info-card text-center" data-aos="fade-up" data-aos-delay="150" style="margin-top: 20px; padding: 2rem 1.5rem;">
            <span class="card-label" style="background: #0a192f; color: #fff; padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: bold; letter-spacing: 1px;">
                PASS D'ACCÈS VIP SÉCURISÉ
            </span>
            
            <div style="margin: 20px 0;">
                <div style="background: #f8f9fa; border: 2px dashed var(--gold, #c5a059); border-radius: 20px; padding: 15px; display: inline-block; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $invitation->id }}&color=0a192f" alt="QR Code d'authentification unique" style="display: block; max-width: 100%; height: auto;">
                </div>
            </div>

            <div style="font-size: 0.85rem; font-weight: bold; color: #0a192f; text-transform: uppercase; letter-spacing: 1px;">
                Valable pour : <span style="color: var(--gold, #c5a059);">{{ $invitation->access_count }} Personne(s)</span>
            </div>

            @if($invitation->wedding_table_id)
                <div style="margin-top: 15px; background: rgba(197, 160, 89, 0.12); color: #8a6d3b; padding: 10px; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">
                    <i class="bi bi-grid-3x3-gap-fill me-1"></i> Table assignée : {{ $invitation->weddingTable->name ?? 'Table #'.$invitation->wedding_table_id }}
                </div>
            @endif

            <p style="font-size: 0.75rem; color: #777; line-height: 1.5; margin: 15px auto 0 auto; max-width: 340px; font-weight: 300;">
                Présentez ce QR Code unique à l'équipe d'accueil à l'entrée de la salle pour authentifier et certifier votre invitation.
            </p>
        </div>

        <div class="info-card" data-aos="fade-up" data-aos-delay="200" style="margin-top: 20px; border-radius: 30px;">
            <span class="card-label">Le Déroulement</span>
            <h2 class="card-title">Ordre du Jour</h2>

            <div class="timeline">
                {{-- On trie par date puis par heure pour un affichage chronologique parfait --}}
                @forelse($wedding->programs->sortBy(['event_date', 'event_time']) as $program)
                <div class="timeline-item">
                    <span class="event-time">
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($program->event_time)->format('H:i') }}
                    </span>
                    
                    <div class="event-title">
                        @if($program->type === 'soiree')
                            Soirée Dansante
                        @else
                            Mariage {{ ucfirst($program->type) }}
                        @endif
                    </div>
                    
                    <div class="event-details">
                        <i class="bi bi-geo-alt-fill me-1"></i> 
                        <strong>Lieu :</strong> {{ $program->venue_name }} <br>
                        
                        @if($program->venue_address)
                        <i class="bi bi-map me-1"></i> 
                        <strong>Adresse :</strong> {{ $program->venue_address }} <br>
                        @endif
                        
                        <i class="bi bi-calendar-event me-1"></i>
                        <strong>Date :</strong> {{ \Carbon\Carbon::parse($program->event_date)->translatedFormat('d F Y') }}
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="bi bi-calendar-x opacity-20" style="font-size: 2rem;"></i>
                    <p class="text-muted small mt-2">Le programme détaillé est en cours de finalisation.</p>
                </div>
                @endforelse
            </div>

            <a href="{{ route('guest.rsvp.form', $invitation->link_token) }}" class="btn-rsvp">
                <i class="bi bi-envelope-heart me-2"></i> Répondre à l'invitation
            </a>
        </div>

        <footer class="py-4 text-center opacity-40">
            <p style="font-size: 0.5rem; letter-spacing: 4px; color: white;">POWERED BY WEDDREAM PRESTIGE, Yetoo Technologie KC 2026</p>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialisation des animations au scroll
        AOS.init({ duration: 1000, once: true });

        // Petit effet de parallaxe sur l'image du couple
        window.addEventListener('scroll', function() {
            let offset = window.pageYOffset;
            if(offset < window.innerHeight * 0.8) {
                document.getElementById('parallax').style.transform = "translateY(" + (offset * 0.3) + "px)";
            }
        });
    </script>
</body>
</html>