<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation d'Honneur | {{ $invitation->guest_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-brown: #5c3a21;
            --gradient-start: #a36f4c;
            --gradient-end: #361f11;
            --bg-cream-light: #f5ece3;
            --accent-orange: #d97736;
            --text-dark: #2b180b;
        }

        body {
            background-color: #d1c4b6;
            font-family: 'Montserrat', sans-serif;
            color: var(--text-dark);
            padding: 20px;
        }

        .folded-invitation-container {
            max-width: 1250px;
            margin: 30px auto;
            background: #fff;
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            border: 1px solid rgba(0,0,0,0.15);
            overflow: hidden;
            border-radius: 4px;
        }

        .fold-panel {
            min-height: 600px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 30px;
            position: relative;
        }

        .fold-panel:not(:last-child) {
            border-right: 1px dashed rgba(54, 31, 17, 0.15);
            box-shadow: inset -15px 0 20px -15px rgba(0, 0, 0, 0.08);
        }
        
        .fold-panel:not(:first-child) {
            box-shadow: inset 15px 0 20px -15px rgba(0, 0, 0, 0.08);
        }

        /* VOLET 1 : Couverture */
        .panel-cover {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            padding: 30px 20px;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .cover-photo-wrapper {
            position: relative;
            width: 100%;
            height: 280px;
            margin: 15px 0;
            overflow: hidden;
            border-radius: 2px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .panel-couple-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
        }

        .cover-header-title {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .cover-monogram {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            letter-spacing: 3px;
            border-bottom: 1px solid rgba(255,255,255,0.4);
            padding-bottom: 5px;
            display: inline-block;
            margin-top: 5px;
        }

        .cover-script-title {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            color: #f1c493;
            margin: 0;
        }

        .cover-names-bottom {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .cover-date-badge {
            background: #732619;
            color: white;
            display: inline-block;
            padding: 4px 15px;
            font-family: 'Cinzel', serif;
            font-size: 0.9rem;
            letter-spacing: 2px;
            font-weight: bold;
            margin-top: 5px;
        }

        /* VOLET 2 : Invitation */
        .panel-invitation {
            background: linear-gradient(to bottom, #ebdcd0 0%, #fff7f2 40%, #ffffff 100%);
            text-align: center;
            justify-content: center;
        }

        .right-main-title {
            font-family: 'Cinzel', serif;
            font-size: 2.8rem;
            color: var(--text-dark);
            letter-spacing: 5px;
            margin-bottom: 0;
        }

        .right-subtitle {
            font-size: 0.8rem;
            letter-spacing: 6px;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--accent-orange);
            margin-bottom: 40px;
        }

        .intro-phrase {
            font-size: 0.95rem;
            color: #5c4637;
            margin: 20px 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .couple-highlight-names {
            font-family: 'Great Vibes', cursive;
            font-size: 3.5rem;
            color: var(--primary-brown);
            line-height: 1.1;
            margin: 15px 0;
        }
        
        .couple-highlight-names span {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            display: inline-block;
            margin: 0 10px;
            color: var(--accent-orange);
        }

        .solicitation-text {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            color: #4d3a2f;
            max-width: 90%;
            margin: 20px auto 0 auto;
            line-height: 1.6;
            font-weight: 500;
        }

        /* VOLET 3 : Programme */
        .panel-program {
            background: linear-gradient(to right, #fff7f2 0%, #ffffff 100%);
            justify-content: space-between;
        }

        .event-step {
            margin-bottom: 22px;
            text-align: center;
        }

        .event-type-pill {
            background: linear-gradient(to right, #d97736, #a6521e);
            color: white;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            padding: 4px 16px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .program-time-text {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--primary-brown);
        }

        .program-location-text {
            font-size: 0.76rem;
            color: #554135;
            line-height: 1.4;
            margin-top: 2px;
        }

        .footer-right-zone {
            border-top: 1px solid rgba(115, 74, 48, 0.15);
            padding-top: 15px;
            background: #fff;
        }

        .config-badge {
            border: 1px solid var(--accent-orange);
            color: var(--accent-orange);
            font-size: 0.62rem;
            text-transform: uppercase;
            font-weight: 700;
            padding: 2px 8px;
            letter-spacing: 1px;
            display: inline-block;
        }

        .table-assignment-box {
            margin-top: 8px; 
            background: rgba(197, 160, 89, 0.1); 
            color: #735a2b; 
            padding: 8px; 
            border-radius: 8px; 
            font-size: 0.78rem; 
            font-weight: 600;
            border-left: 3px solid var(--accent-orange);
        }

        .rsvp-title {
            font-family: 'Cinzel', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-brown);
            letter-spacing: 1px;
            line-height: 1;
        }

        #qrcode img {
            display: inline-block !important; /* Force l'affichage de l'image générée par le script à l'impression */
        }

        /* ==========================================================================
           CORRECTIONS MAJEURES POUR L'IMPRESSION (PAYSAGE STABLE)
           ========================================================================== */
        @media print {
            @page {
                size: landscape; /* Force le navigateur à configurer la feuille en paysage */
                margin: 0;
            }
            
            body { 
                background: white !important; 
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important; /* Force le rendu des couleurs & images de fond */
                print-color-adjust: exact !important;
            }

            .no-print { display: none !important; }

            .folded-invitation-container {
                margin: 0 !important;
                box-shadow: none !important;
                max-width: 100% !important;
                width: 100% !important;
                border: none !important;
            }

            /* Force les colonnes Bootstrap à garder une structure en 3 volets égaux (sans s'empiler) */
            .folded-invitation-container .row {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                width: 100% !important;
            }

            .folded-invitation-container .col-md-4 {
                width: 33.3333% !important;
                flex: 0 0 33.3333% !important;
                max-width: 33.3333% !important;
            }

            .fold-panel {
                min-height: 100vh !important; /* Ajuste la hauteur des volets à la page entière */
                padding: 30px 20px !important;
            }

            /* Garantit le centrage absolu de la photo de couverture dans son espace */
            .cover-photo-wrapper {
                height: 260px !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                margin: 10px 0 !important;
            }

            /* Sécurise le contraste du QR code */
            .bg-white {
                background-color: #ffffff !important;
                padding: 4px !important;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-2 mb-4 no-print text-center">
        <button onclick="window.print();" class="btn btn-dark px-4 py-2 shadow" style="background: var(--primary-brown); border: none; border-radius: 50px;">
            <i class="bi bi-printer-fill me-2"></i> Lancer l'Impression
        </button>
        <a href="{{ route('invitations.index') }}" class="btn btn-outline-secondary px-4 py-2 ms-2" style="border-radius: 50px;">
            Retour au carnet
        </a>
    </div>

    <div class="folded-invitation-container">
        <div class="row g-0">
            
            <!-- VOLET 1 : COUVERTURE -->
            <div class="col-md-4 fold-panel panel-cover">
                <div>
                    <div class="cover-header-title">Notre Mariage</div>
                    <div class="cover-monogram">
                        {{ substr($wedding->groom_name ?? 'O', 0, 1) }} & {{ substr($wedding->bride_name ?? 'M', 0, 1) }}
                    </div>
                </div>

                <div class="cover-photo-wrapper">
                    <img src="{{ $wedding->cover_photo ? asset('storage/' . $wedding->cover_photo) : 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069' }}" 
                         class="panel-couple-photo" alt="Photo Couple">
                </div>
                
                <div>
                    <h2 class="cover-script-title">Wedding</h2>
                    <div class="cover-names-bottom">
                        {{ $wedding->groom_name ?? 'OWEN' }} & {{ $wedding->bride_name ?? 'MWAI' }}
                    </div>
                    
                    @if($wedding->wedding_date)
                        <div class="cover-date-badge">
                            {{ \Carbon\Carbon::parse($wedding->wedding_date)->format('d.m.Y') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- VOLET 2 : L'INVITATION -->
            <div class="col-md-4 fold-panel panel-invitation">
                <div>
                    <h1 class="right-main-title">Invitation</h1>
                    <div class="right-subtitle">d'honneur</div>
                    
                    <div class="intro-phrase">C'est avec joie que</div>
                    
                    <div class="couple-highlight-names">
                        {{ $wedding->groom_name ?? 'Owen' }} <span>et</span> {{ $wedding->bride_name ?? 'Mwai' }}
                    </div>
                    
                    <div class="intro-phrase" style="font-size: 0.8rem; margin-top: 5px;">Vous invitent à célébrer leur union sainte.</div>
                    
                    <hr style="width: 40%; margin: 25px auto; border-color: var(--accent-orange);">
                    
                    <div class="text-muted small text-uppercase letter-spacing-2">Invité d'Honneur :</div>
                    <div class="guest-highlight-name" style="font-family: 'Cinzel', serif; font-size: 1.4rem; font-weight: 700; color: var(--primary-brown); margin-top: 5px;">
                        {{ $invitation->guest_name }}
                    </div>
                    
                    <div class="solicitation-text">
                        Sont pleinement conviés à prendre part chaleureusement aux festivités et célébrations marquant le déroulement de leur mariage.
                    </div>
                </div>
            </div>

            <!-- VOLET 3 : LE PROGRAMME & RSVP -->
            <div class="col-md-4 fold-panel panel-program">
                
                <div class="program-flow-container">
                    <div class="text-center mb-3 text-uppercase tracking-wider font-semibold" style="font-size: 0.8rem; color: var(--primary-brown); letter-spacing: 2px;">
                        <i class="bi bi-calendar3 me-1"></i> Programme des festivités
                    </div>
                    
                    @forelse($wedding->programs->sortBy(['event_date', 'event_time']) as $program)
                        <div class="event-step">
                            <span class="event-type-pill">
                                @if($program->type === 'soiree')
                                    Soirée Dansante
                                @else
                                    Mariage {{ ucfirst($program->type) }}
                                @endif
                            </span>
                            
                            <div class="program-time-text">
                                {{ \Carbon\Carbon::parse($program->event_date)->locale('fr')->translatedFormat('l d F Y') }} <br>
                                à {{ \Carbon\Carbon::parse($program->event_time)->format('H\hi') }}
                            </div>
                            
                            <div class="program-location-text">
                                <strong>Lieu :</strong> {{ $program->venue_name }}
                                @if($program->venue_address)
                                    <br><span class="text-muted" style="font-size: 0.7rem;">{{ $program->venue_address }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-muted small fst-italic py-4 text-center">Le programme officiel est en cours de finalisation.</div>
                    @endforelse
                </div>

                <div class="footer-right-zone">
                    <div class="row align-items-center g-0">
                        <div class="col-7 pe-2">
                            <span class="config-badge mb-1">
                                {{ ucfirst($invitation->type ?? 'Singleton') }}
                            </span>
                            <div class="text-dark" style="font-size: 0.7rem; line-height: 1.3;">
                                <i class="bi bi-people-fill me-1"></i> Accès : {{ $invitation->access_count ?? 1 }} Pers.
                            </div>
                            
                            <div class="table-assignment-box">
                                <i class="bi bi-grid-3x3-gap-fill me-1"></i> {{ $invitation->weddingTable->name ?? 'Table #'.$invitation->wedding_table_id }}
                            </div>
                        </div>
                        
                        <div class="col-5 text-center" style="border-left: 1px solid rgba(0,0,0,0.08)">
                            <div class="d-inline-block bg-white p-2 border rounded mb-1">
                                <div id="qrcode"></div>
                            </div>
                            <div class="rsvp-title">RSVP</div>
                            <span style="font-size: 0.5rem; text-transform: uppercase; color: #666; display: block; letter-spacing: 0.5px;">Scannez pour confirmer</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Script de génération (Taille augmentée à 90 pour une meilleure définition d'impression) -->
    <script>
        const guestUrl = "{{ route('guest.welcome', $invitation->link_token) }}";
        
        new QRCode(document.getElementById("qrcode"), {
            text: guestUrl,
            width: 90,
            height: 90,
            colorDark : "#361f11",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>
</body>
</html>