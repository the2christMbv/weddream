<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation d'Honneur | {{ $invitation->guest_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        /* Importation de toutes les polices requises pour les différents thèmes */
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Alex+Brush&family=Bodoni+Moda:ital,wght@0,400;0,700;1,400&family=Sacramento&display=swap');

        body {
            background-color: #d1c4b6;
            font-family: 'Montserrat', sans-serif;
            padding: clamp(10px, 3vw, 20px);
        }

        /* Base commune de la structure de l'invitation */
        .folded-invitation-container {
            max-width: 1250px;
            margin: 15px auto 30px auto;
            background: #fff;
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            border: 1px solid rgba(0,0,0,0.15);
            overflow: hidden;
            border-radius: 8px;
        }

        .fold-panel {
            min-height: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: clamp(30px, 5vw, 45px) clamp(20px, 4vw, 30px);
            position: relative;
        }

        /* ==========================================================================
           DÉFINITION DES 4 MODÈLES D'INVITATIONS (Thèmes CSS)
           ========================================================================== */

        /* --- MODÈLE 1 : Terracotta Boho & Chic (Ton modèle d'origine) --- */
        .theme-modele_1 {
            --primary-color: #5c3a21;
            --gradient-start: #a36f4c;
            --gradient-end: #361f11;
            --accent-color: #d97736;
            --text-dark: #2b180b;
            --bg-panel-2: linear-gradient(to bottom, #ebdcd0 0%, #fff7f2 40%, #ffffff 100%);
            --font-title: 'Cinzel', serif;
            --font-script: 'Great Vibes', cursive;
        }

        /* --- MODÈLE 2 : Or Blanc & Royal (Prestige Épuré) --- */
        .theme-modele_2 {
            --primary-color: #1a1a1a;
            --gradient-start: #2c2c2c;
            --gradient-end: #000000;
            --accent-color: #c5a059; /* Or métallisé */
            --text-dark: #111111;
            --bg-panel-2: linear-gradient(to bottom, #f9f6f0 0%, #ffffff 100%);
            --font-title: 'Bodoni Moda', serif;
            --font-script: 'Alex Brush', cursive;
        }

        /* --- MODÈLE 3 : Eucalyptus & Nature (Champêtre / Botanique) --- */
        .theme-modele_3 {
            --primary-color: #2d4a43; /* Vert d'eau sombre */
            --gradient-start: #4a7066;
            --gradient-end: #1b302b;
            --accent-color: #8fa89b; /* Vert sauge doux */
            --text-dark: #1e332e;
            --bg-panel-2: linear-gradient(to bottom, #edf2f0 0%, #ffffff 100%);
            --font-title: 'Playfair Display', serif;
            --font-script: 'Sacramento', cursive;
        }

        /* --- MODÈLE 4 : Nuit Étoilée & Glamour (Bleu Nuit & Or Rose) --- */
        .theme-modele_4 {
            --primary-color: #0b1b3d; /* Bleu nuit profond */
            --gradient-start: #162a54;
            --gradient-end: #050c1e;
            --accent-color: #e5a9a9; /* Or Rose / Blush */
            --text-dark: #09152e;
            --bg-panel-2: linear-gradient(to bottom, #eef2f7 0%, #ffffff 100%);
            --font-title: 'Cinzel', serif;
            --font-script: 'Great Vibes', cursive;
        }

        /* ==========================================================================
           APPLICATION DYNAMIQUE DES VARIABLES AUX ÉLÉMENTS
           ========================================================================== */
        .folded-invitation-container {
            color: var(--text-dark);
        }

        .panel-cover {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .cover-header-title {
            font-family: var(--font-title);
            font-size: clamp(1.4rem, 2.5vw, 1.8rem);
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .cover-monogram {
            font-family: var(--font-title);
            font-size: 1.1rem;
            letter-spacing: 3px;
            border-bottom: 1px solid rgba(255,255,255,0.4);
            padding-bottom: 5px;
            display: inline-block;
            margin-top: 5px;
        }

        .cover-script-title {
            font-family: var(--font-script);
            font-size: clamp(2.3rem, 5vw, 3.5rem);
            color: var(--accent-color);
            margin: 0;
        }

        .cover-names-bottom {
            font-family: var(--font-title);
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            letter-spacing: 2px;
            font-weight: 600;
        }

        .cover-date-badge {
            background: var(--primary-color);
            border: 1px solid var(--accent-color);
            color: white;
            display: inline-block;
            padding: 4px 15px;
            font-family: var(--font-title);
            font-size: 0.9rem;
            letter-spacing: 2px;
            font-weight: bold;
            margin-top: 8px;
            border-radius: 2px;
        }

        .panel-invitation {
            background: var(--bg-panel-2);
            text-align: center;
            justify-content: center;
        }

        .right-main-title {
            font-family: var(--font-title);
            font-size: clamp(2.2rem, 4vw, 2.8rem);
            color: var(--text-dark);
            letter-spacing: 5px;
            margin-bottom: 0;
        }

        .right-subtitle {
            font-size: 0.8rem;
            letter-spacing: 6px;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: clamp(20px, 5vw, 40px);
        }

        .couple-highlight-names {
            font-family: var(--font-script);
            font-size: clamp(2.8rem, 6vw, 3.8rem);
            color: var(--primary-color);
            line-height: 1.2;
            margin: 10px 0;
        }
        
        .couple-highlight-names span {
            font-family: var(--font-title);
            font-size: clamp(1.4rem, 3vw, 1.8rem);
            display: inline-block;
            margin: 0 10px;
            color: var(--accent-color);
        }

        .guest-highlight-name {
            font-family: var(--font-title);
        }

        .event-type-pill {
            background: linear-gradient(to right, var(--gradient-start), var(--primary-color));
            border: 1px solid var(--accent-color);
            color: white;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            padding: 4px 16px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 6px;
        }

        .program-time-text {
            color: var(--primary-color);
        }

        .config-badge {
            border: 1px solid var(--accent-color);
            color: var(--primary-color);
        }

        .table-assignment-box {
            border-left: 3px solid var(--accent-color);
            background: rgba(0,0,0,0.03);
        }

        .rsvp-title {
            font-family: var(--font-title);
            color: var(--primary-color);
        }

        /* --- Mise en page et responsivité des volets --- */
        .cover-photo-wrapper {
            position: relative;
            width: 100%;
            height: clamp(220px, 40vw, 280px);
            margin: 20px 0;
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .panel-couple-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media(min-width: 992px) {
            .fold-panel { min-height: 600px; }
            .fold-panel:not(:last-child) {
                border-right: 1px dashed rgba(0, 0, 0, 0.15);
                box-shadow: inset -15px 0 20px -15px rgba(0, 0, 0, 0.08);
            }
        }

        @media(max-width: 991.98px) {
            .fold-panel:not(:last-child) { border-bottom: 1px dashed rgba(0, 0, 0, 0.25); }
        }

        /* ==========================================================================
           MEDIA QUERIES PRESTIGE POUR L'IMPRESSION PHYSIQUE EN 3 VOLETS
           ========================================================================== */
        @media print {
    @page {
        size: A4 landscape;
        margin: 10mm;
    }
    
    body { 
        background: white !important; 
        padding: 0 !important;
        margin: 0 !important;
        /* Cette ligne force le navigateur à imprimer les couleurs et arrière-plans */
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .no-print { display: none !important; }

    /* Assurez-vous que vos conteneurs héritent de ce comportement */
    .folded-invitation-container, .fold-panel {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .row {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        width: 100% !important;
    }

    .col-lg-4 {
        /* Force les 3 colonnes à occuper exactement 33.33% chacune */
        width: 33.333333% !important;
        flex: 0 0 33.333333% !important;
        max-width: 33.333333% !important;
    }

    .fold-panel {
        /* Important : supprime le min-height qui peut pousser le contenu */
        min-height: auto !important;
        height: 100% !important; 
        padding: 15px !important;
        border: none !important; /* Enlever la bordure dashed pour l'impression propre */
    }
}
    </style>
</head>
<body>

    <!-- SÉLECTEUR DE MODÈLE EN TEMPS RÉEL (Pour tester ou pour l'administration en Direct) -->
    <div class="container mt-2 mb-4 no-print text-center bg-light p-3 border rounded shadow-sm">
        <div class="row align-items-center justify-content-center g-2">
            <div class="col-auto">
                <label class="fw-bold small text-muted text-uppercase me-2"><i class="bi bi-palette2 me-1"></i> Modèle actif :</label>
                <!-- Si tu as sauvegardé le choix en BDD, remplace par : id="theme-selector" et met la variable Laravel -->
                <select class="form-select form-select-sm d-inline-block w-auto" onchange="changeModel(this.value)">
                    <option value="modele_1" {{ (isset($theme) && $theme == 'modele_1') ? 'selected' : '' }}>Modèle 1 : Terracotta Chic</option>
                    <option value="modele_2" {{ (isset($theme) && $theme == 'modele_2') ? 'selected' : '' }}>Modèle 2 : Or Blanc & Royal</option>
                    <option value="modele_3" {{ (isset($theme) && $theme == 'modele_3') ? 'selected' : '' }}>Modèle 3 : Eucalyptus Nature</option>
                    <option value="modele_4" {{ (isset($theme) && $theme == 'modele_4') ? 'selected' : '' }}>Modèle 4 : Nuit Étoilée Glamour</option>
                </select>
            </div>
            <div class="col-auto">
                <button onclick="window.print();" class="btn btn-dark btn-sm px-4 shadow-sm" style="border-radius: 50px; background: #222;">
                    <i class="bi bi-printer-fill me-2"></i> Lancer l'Impression
                </button>
                <a href="{{ route('invitations.index') }}" class="btn btn-outline-secondary btn-sm px-3 ms-2" style="border-radius: 50px;">
                    <i class="bi bi-journal-bookmark"></i> Retour au carnet
                </a>
            </div>
        </div>
    </div>

    <!-- LE TRITYPQUE D'HONNEUR - Injection dynamique de la classe du modèle choisi -->
    <div id="invitation-wrapper" class="folded-invitation-container theme-{{ $theme ?? 'modele_1' }}">
        <div class="row g-0">
            
            <!-- VOLET 1 : COUVERTURE -->
            <div class="col-12 col-lg-4 fold-panel panel-cover">
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
            <div class="col-12 col-lg-4 fold-panel panel-invitation">
                <div>
                    <h1 class="right-main-title">Invitation</h1>
                    <div class="right-subtitle">d'honneur</div>
                    
                    <div class="intro-phrase" style="font-size: 0.75rem; letter-spacing:1px;">C'est avec joie que</div>
                    
                    <div class="couple-highlight-names">
                        {{ $wedding->groom_name ?? 'Owen' }} <span>et</span> {{ $wedding->bride_name ?? 'Mwai' }}
                    </div>
                    
                    <div class="intro-phrase" style="font-size: 0.75rem; margin-top: 5px;">Vous invitent à célébrer leur union sainte.</div>
                    
                    <hr style="width: 40%; margin: 25px auto; border-color: var(--accent-color);">
                    
                    <div class="text-muted small text-uppercase" style="letter-spacing: 2px;">Invité d'Honneur :</div>
                    <div class="guest-highlight-name" style="font-size: 1.4rem; font-weight: 700; margin-top: 5px;">
                        {{ $invitation->guest_name }}
                    </div>
                    
                    <div class="solicitation-text" style="font-size: 0.85rem; color: #444; line-height: 1.6; max-width:90%; margin:15px auto;">
                        Sont pleinement conviés à prendre part chaleureusement aux festivités et célébrations marquant le déroulement de leur mariage.
                    </div>
                </div>
            </div>

            <!-- VOLET 3 : LE PROGRAMME & RSVP -->
            <div class="col-12 col-lg-4 fold-panel panel-program" style="background: #fff;">
                
                <div class="program-flow-container">
                    <div class="text-center mb-3 text-uppercase font-semibold" style="font-size: 0.8rem; letter-spacing: 2px;">
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
                            
                            <div class="program-time-text" style="font-size: 0.78rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                                {{ \Carbon\Carbon::parse($program->event_date)->locale('fr')->translatedFormat('l d F Y') }} <br>
                                à {{ \Carbon\Carbon::parse($program->event_time)->format('H\hi') }}
                            </div>
                            
                            <div class="program-location-text" style="font-size: 0.78rem; margin-top: 2px;">
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

                <div class="footer-right-zone" style="border-top: 1px solid rgba(0,0,0,0.08); padding-top: 15px;">
                    <div class="row align-items-center g-0">
                        <div class="col-7 pe-2 text-start">
                            <span class="config-badge mb-1" style="font-size: 0.62rem; text-transform: uppercase; font-weight: 700; padding: 2px 8px; letter-spacing: 1px; display: inline-block;">
                                {{ ucfirst($invitation->type ?? 'Singleton') }}
                            </span>
                            <div class="text-dark" style="font-size: 0.7rem; line-height: 1.3;">
                                <i class="bi bi-people-fill me-1"></i> Accès : {{ $invitation->access_count ?? 1 }} Pers.
                            </div>
                            
                            <div class="table-assignment-box" style="margin-top: 8px; padding: 8px; border-radius: 8px; font-size: 0.78rem; font-weight: 600;">
                                <i class="bi bi-grid-3x3-gap-fill me-1"></i> {{ $invitation->weddingTable->name ?? 'Table #'.$invitation->wedding_table_id }}
                            </div>
                        </div>
                        
                        <div class="col-5 text-center" style="border-left: 1px solid rgba(0,0,0,0.08)">
                            <div class="d-inline-block bg-white p-2 border rounded mb-1">
                                <div id="qrcode"></div>
                            </div>
                            <div class="rsvp-title" style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; line-height: 1;">RSVP</div>
                            <span style="font-size: 0.5rem; text-transform: uppercase; color: #666; display: block; letter-spacing: 0.5px;">Scannez pour confirmer</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT DE RE-RENDU DU QR CODE ET DU CHANGEMENT DE THÈME -->
    <script>
    // On définit simplement l'ID ici
    const guestId = "{{ $invitation->id }}";

    // IMPORTANT : On utilise guestId pour le QR code
    const qrData = guestId; 

    let qrcodeContainer = document.getElementById("qrcode");

    // Initialisation du QR code
    function generateQrCode(darkColor) {
        qrcodeContainer.innerHTML = ""; 
        
        new QRCode(qrcodeContainer, {
            text: qrData, // Maintenant, ceci ne contient que l'ID (ex: "123")
            width: 100, 
            height: 100,
            colorDark : darkColor,
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H 
        });
    }

    // Fonction pour intervertir les modèles d'invitation dynamiquement
    function changeModel(themeName) {
        let container = document.getElementById('invitation-wrapper');
        container.className = "folded-invitation-container";
        container.classList.add('theme-' + themeName);

        let qrColor = "#361f11"; 
        if (themeName === 'modele_2') qrColor = "#1a1a1a";
        if (themeName === 'modele_3') qrColor = "#1b302b";
        if (themeName === 'modele_4') qrColor = "#050c1e";
        
        generateQrCode(qrColor);
    }

    window.onload = function() {
        let defaultTheme = "{{ $theme ?? 'modele_1' }}";
        changeModel(defaultTheme);
    };
</script>
</body>
</html>