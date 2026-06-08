<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression Chevalet - Alignement Croisé (90° / 270°)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght=0,600;1,400&family=Plus+Jakarta+Sans:wght@400;600&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: white;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }

        .a4-container {
            width: 297mm;
            height: 210mm;
            max-width: 297mm;
            max-height: 210mm;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-sizing: border-box;
            background: #fff;
        }

        .half-page {
            height: 210mm;
            position: relative;
            overflow: hidden;
            padding: 10mm;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }

        .left-side {
            border-right: 1px dashed #c5a059;
        }

        .right-side {
            background: #fdfbf7;
        }

        /* Base pour le contenu pivoté */
        .rotated-content {
            width: 190mm;
            height: 135mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            position: relative;
        }

        /* --- DEVANT (GAUCHE) : ORIENTATION À 90° --- */
        .rot-90 {
            transform: rotate(90deg);
            transform-origin: center;
        }

        /* --- DERRIÈRE (DROITE) : ORIENTATION À 270° --- */
        .rot-270 {
            transform: rotate(270deg);
            transform-origin: center;
        }

        .wedding-bg-table {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('{{ $wedding && $wedding->cover_photo ? asset("storage/" . $wedding->cover_photo) : "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069" }}');
            background-size: cover;
            background-position: center;
            filter: brightness(0.65);
            z-index: 1;
            border-radius: 4px;
        }

        .decor-border {
            border: 1px solid #c5a059;
            padding: 8mm;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            text-align: center;
            position: relative;
            z-index: 2;
            box-sizing: border-box;
        }

        .table-glass-box {
            background: rgba(0, 0, 0, 0.4); 
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10mm 5mm;
            border-radius: 12px;
            width: 100%;
            color: white;
        }

        /* --- STYLES DES TEXTES --- */
        .welcome-text {
            color: #c5a059; 
            letter-spacing: 5px; 
            font-size: 1rem; 
            text-transform: uppercase; 
            font-weight: 600;
            margin-bottom: 3mm;
        }

        .table-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 3mm;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .wedding-names {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.5rem;
            color: #f4e8c1;
        }

        /* Menu */
        .menu-header h2 {
            font-family: 'Playfair Display', serif;
            color: #c5a059;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.6rem;
            margin-bottom: 1mm;
        }

        .menu-divider {
            width: 40px;
            height: 2px;
            background: #c5a059;
            margin: 0 auto 4mm auto;
        }

        .drinks-list {
            width: 100%;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .drink-item {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 3mm;
            font-size: 1rem;
        }

        .drink-name {
            font-weight: 600;
            color: #111827;
        }

        .drink-dots {
            flex-grow: 1;
            border-bottom: 1px dotted #c5a059;
            margin: 0 8px;
            position: relative;
            top: -4px;
        }

        .drink-type {
            font-size: 0.85rem;
            color: #c5a059;
            font-style: italic;
        }

        @media print {
            .left-side {
                border-right: none !important;
            }
            .btn-print-actions {
                display: none !important;
            }
        }

        .btn-print-actions {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background: white;
            padding: 10px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <div class="btn-print-actions">
        <button onclick="window.print();" class="btn btn-success rounded-pill px-4 me-2">
            🖨️ Imprimer 
        </button>
        <button onclick="window.close();" class="btn btn-light rounded-pill px-3">
            Fermer
        </button>
    </div>

    <div class="a4-container">
        
        <div class="half-page left-side">
            <div class="rotated-content rot-90">
                <div class="wedding-bg-table"></div>
                <div class="decor-border">
                    <div class="table-glass-box">
                        <div class="welcome-text">Bienvenue</div>
                        <div class="table-title">Table {{ $tableName ?? $table->name }}</div>
                        <div class="wedding-names">{{ $wedding->title ?? 'Mariage de Prestige' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="half-page right-side">
            <div class="rotated-content rot-270">
                <div class="decor-border">
                    <div class="menu-header">
                        <h2>Menu des Boissons</h2>
                        <div class="menu-divider"></div>
                    </div>

                    <div class="drinks-list">
                        @forelse($drinks as $drink)
                            <div class="drink-item">
                                <span class="drink-name">{{ $drink->name }}</span>
                                <span class="drink-dots"></span>
                                <span class="drink-type">{{ $drink->category ?? 'Sélection' }}</span>
                            </div>
                        @empty
                            <div class="text-center text-muted italic">
                                Aucune boisson affectée.
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-auto text-center">
                        <small style="color: #c5a059; letter-spacing: 1px; font-size: 0.7rem;">WedDream Édition</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 1200);
        };
    </script>
</body>
</html>