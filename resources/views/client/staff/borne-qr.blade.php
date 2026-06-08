<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimer QR Code Borne - WedDream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Rendu fluide et responsive de la carte */
        .print-card {
            background: white;
            border: 2px solid #000;
            border-radius: 20px;
            padding: 40px 20px;
            width: 90%;
            max-width: 500px;
            margin: 30px auto;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        /* Conteneur QR s'adaptant à la taille de l'écran */
        .qr-container {
            border: 4px solid #c5a059; /* Couleur Or Prestige */
            padding: 15px;
            display: inline-block;
            border-radius: 15px;
            margin: 20px 0;
            max-width: 100%;
            background: #fff;
        }
        .qr-container img {
            max-width: 100%;
            height: auto;
            display: block;
        }
        
        /* Ajustements pour l'impression papier */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #fff;
            }
            .print-card {
                border: none;
                box-shadow: none;
                margin: 0 auto;
                padding: 10px;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Barre d'outils responsive (Masquée lors de l'impression) -->
    <div class="container mt-4 no-print text-center px-3">
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <!-- Bouton Retour -->
            <a href="{{ route('supervisor.dashboard', ['id' => $wedding->id]) }}" class="btn btn-outline-secondary btn-lg shadow d-flex align-items-center fw-semibold">
                <i class="bi bi-arrow-left me-2"></i> Retour
            </a>
            <!-- Bouton Imprimer -->
            <button class="btn btn-dark btn-lg shadow d-flex align-items-center" onclick="window.print()">
                <i class="bi bi-printer-fill me-2"></i> Imprimer
            </button>
            <!-- Bouton Télécharger -->
            <button class="btn btn-warning btn-lg shadow d-flex align-items-center fw-semibold" onclick="downloadQR()">
                <i class="bi bi-download me-2"></i> Télécharger le QR
            </button>
        </div>
        <p class="text-muted small mt-2">Ces options de navigation et d'outils disparaissent automatiquement sur la feuille imprimée.</p>
        <hr>
    </div>

    <!-- Contenu du panneau d'accueil -->
    <div class="print-card">
        <h1 class="px-2" style="font-size: calc(1.5rem + 1vw); font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 1px;">
            BIENVENUE
        </h1>
        <p class="text-muted mb-1" style="font-size: 1.1rem;">Au mariage de</p>
        <h2 class="px-2" style="font-size: calc(1.2rem + 0.6vw); font-weight: 700; color: #c5a059;">
            {{ $wedding->bride_name }} & {{ $wedding->groom_name }}
        </h2>
        
        <div style="color: #c5a059; font-size: 1.5rem;">✦ ✦ ✦</div>

        <!-- QR Code réactif -->
        <div class="qr-container">
            <img id="qr-image" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode($borneValue) }}&color=0f172a" alt="QR Code Borne">
        </div>

        <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin-top: 10px;">
            <i class="bi bi-qr-code-scan me-2"></i> SCANNEZ-MOI
        </h3>
        <p class="text-muted mx-auto px-3" style="max-width: 380px; font-size: 0.9rem; line-height: 1.5;">
            Ouvrez votre invitation numérique, cliquez sur <strong>"Scanner la Borne"</strong> et scannez ce code pour confirmer votre présence et découvrir votre table.
        </p>
    </div>

    <!-- Script de téléchargement à la volée -->
    <script>
        function downloadQR() {
            const qrImageUrl = document.getElementById('qr-image').src;
            
            // On récupère les noms pour un nom de fichier personnalisé propre
            const bride = "{{ Str::slug($wedding->bride_name) }}";
            const groom = "{{ Str::slug($wedding->groom_name) }}";
            const filename = `qr-borne-${bride}-${groom}.png`;

            // Utilisation de fetch pour contourner les restrictions CORS sur le téléchargement direct
            fetch(qrImageUrl)
                .then(response => response.blob())
                .then(blob => {
                    const blobURL = URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = blobURL;
                    link.download = filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(blobURL);
                })
                .catch(() => {
                    // Fallback basique au cas où le fetch échoue (ou restrictions réseau)
                    const link = document.createElement('a');
                    link.href = qrImageUrl;
                    link.target = '_blank';
                    link.download = filename;
                    link.click();
                });
        }
    </script>
</body>
</html>