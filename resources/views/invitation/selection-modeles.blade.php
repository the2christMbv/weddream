<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Photo de Couverture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap');

        :root {
            --gold: #c5a059;
            --dark: #1a1a1a;
            --light-gold: #f4e8c1;
        }

        body {
            background-color: #fcfcfc;
            background-image: radial-gradient(var(--gold) 0.5px, transparent 0.5px);
            background-size: 30px 30px;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* BANNIÈRE DE PRESTIGE DYNAMIQUE */
        .banner-invitation {
            background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), 
                        url('{{ $wedding && $wedding->cover_photo ? asset("storage/" . $wedding->cover_photo) : "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069" }}');
            background-size: cover;
            background-position: center;
            padding: clamp(40px, 6vw, 70px) 20px;
            color: white;
            text-align: center;
            border-bottom: 3px solid var(--gold);
            position: relative;
        }

        .banner-invitation h1 {
            font-family: 'Cinzel', serif;
            letter-spacing: clamp(2px, 1vw, 6px);
            text-transform: uppercase;
            font-weight: 700;
            font-size: clamp(1.8rem, 4vw, 3rem);
        }

        .card-custom {
            border: none;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.06);
            background: white;
            overflow: hidden;
            max-width: 650px;
            margin: -30px auto 0 auto; /* Légère superposition sur la bannière */
            position: relative;
            z-index: 10;
            border: 1px solid rgba(197, 160, 89, 0.2);
        }

        .card-header-gold {
            background: var(--dark);
            color: var(--gold);
            padding: 1.5rem;
            font-family: 'Cinzel', serif;
            border-bottom: 2px solid var(--gold);
        }

        .btn-gold {
            background: var(--gold);
            color: white;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            border: none;
            padding: 14px;
            border-radius: 50px;
            transition: 0.3s ease;
            letter-spacing: 1px;
        }

        @media (min-width: 992px) {
            .btn-gold:hover { 
                background: #b38728; 
                color: white; 
                transform: translateY(-2px); 
                box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
            }
        }

        .preview-container {
            border: 2px dashed var(--gold);
            border-radius: 16px;
            overflow: hidden;
            max-height: 280px;
            background: #fafafa;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .preview-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        /* Adaptations Mobiles Critiques */
        @media (max-width: 575.98px) {
            .btn-return-mobile {
                position: static !important;
                margin: 0 auto 15px auto !important;
                display: inline-flex !important;
            }
            .card-custom {
                margin: -15px auto 0 auto;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>

    <section class="banner-invitation mb-4">
        <div class="container">
            <a href="{{ route('client.dashboard') }}" class="btn btn-outline-light position-absolute top-0 start-0 mt-4 ms-4 rounded-circle d-flex align-items-center justify-content-center btn-return-mobile" style="width: 45px; height: 45px; border-color: var(--gold); color: var(--gold); transition: 0.3s;" title="Retour au tableau de bord">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>

            <h1>WedDream</h1>
            <p class="lead small text-uppercase tracking-wider opacity-75">Personnalisation de l'Écran d'Accueil</p>
        </div>
    </section>

    <div class="container pb-5 px-3">
        <div class="card card-custom shadow-sm">
            <div class="card-header-gold text-center">
                <h5 class="mb-1 text-uppercase" style="letter-spacing: 2px;">Image de Fond</h5>
                <p class="text-muted small mb-0" style="font-family: 'Montserrat', sans-serif; opacity: 0.85;">Cette illustration apparaîtra en arrière-plan de vos invitations en ligne</p>
            </div>
            
            <div class="card-body p-4 p-md-5">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert" style="background-color: #f4fbf7; color: #1f7842;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('client.invitation.save-settings') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4 text-center">
                        <label class="form-label small fw-bold text-muted text-uppercase d-block mb-3" style="letter-spacing: 1px;">Rendu Actuel</label>
                        <div class="preview-container d-flex align-items-center justify-content-center position-relative">
                            @if($wedding && $wedding->cover_photo)
                                <img id="coverPreview" src="{{ asset('storage/' . $wedding->cover_photo) }}" class="preview-image" alt="Photo de couverture">
                            @else
                                <div id="noPreviewPlaceholder" class="py-5 text-muted w-100">
                                    <div class="icon-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(197, 160, 89, 0.1); border-radius: 50%; color: var(--gold);">
                                        <i class="bi bi-image fs-3"></i>
                                    </div>
                                    <span class="small d-block px-3">Aucun visuel personnalisé. L'arrière-plan par défaut de WedDream est actuellement actif.</span>
                                </div>
                                <img id="coverPreview" src="" class="preview-image d-none" alt="Prévisualisation">
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="cover_photo" class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">Téléverser un nouveau fichier</label>
                        <input type="file" name="cover_photo" id="cover_photo" class="form-control form-control-lg shadow-sm" accept="image/*" style="border-radius: 10px; font-size: 0.95rem;" required>
                        <div class="form-text text-muted mt-2 small">
                            <i class="bi bi-info-circle-fill text-secondary me-1"></i> Formats acceptés : JPG, PNG. Optez pour une photo lumineuse au format paysage (horizontal).
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 shadow-sm py-3 mt-2 text-uppercase">
                        <i class="bi bi-camera-fill me-2"></i> Mettre à jour l'arrière-plan
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('cover_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('coverPreview');
                    const placeholder = document.getElementById('noPreviewPlaceholder');
                    
                    if (previewImg) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('d-none');
                    }
                    
                    if (placeholder) {
                        placeholder.classList.add('d-none');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>