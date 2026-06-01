<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réponse à l'Invitation | WedDream Prestige</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gold-gradient: linear-gradient(135deg, #c5a059 0%, #f1d394 50%, #c5a059 100%);
            --gold-solid: #c5a059;
            --royal-blue: #0a192f;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;
            --white: #ffffff;
            --card-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        body { 
            background-image: linear-gradient(rgba(10, 25, 47, 0.4), rgba(10, 25, 47, 0.4)), 
                              url('https://images.unsplash.com/photo-1469371670807-013ccf25f16a?q=80&w=2070&auto=format&fit=crop');
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            color: var(--text-dark); 
            font-family: 'Montserrat', sans-serif; 
            min-height: 100vh;
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            height: 340px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }

        .hero-image {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            z-index: 1;
            opacity: 0.55;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(10, 25, 47, 0.2), rgba(10, 25, 47, 0.6));
            z-index: 2;
        }

        .hero-title {
            position: relative;
            z-index: 3;
            text-align: center;
            margin-top: -20px;
        }

        .hero-title h1 {
            font-family: 'Cinzel Decorative', serif;
            font-size: 3.2rem;
            font-weight: 700;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            letter-spacing: 4px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-title p {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 6px;
            color: var(--white);
            margin-top: 10px;
            font-weight: 500;
            opacity: 0.9;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
        }

        .main-content {
            position: relative;
            z-index: 10;
            margin-top: -70px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 20px 80px 20px;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 24px; 
            padding: 2.5rem;
            border: 1px solid rgba(197, 160, 89, 0.25);
            box-shadow: var(--card-shadow);
            margin-bottom: 28px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-heading {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--gold-solid);
            margin-bottom: 1.8rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label { 
            font-weight: 500; 
            font-size: 0.85rem;
            color: var(--text-dark); 
            margin-bottom: 10px;
        }

        .form-control, .form-select {
            background: #fafaf7;
            border: 1px solid rgba(0, 0, 0, 0.08);
            color: var(--text-dark);
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-check:checked + .btn-outline-gold {
            background: var(--gold-gradient);
            color: var(--white) !important;
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(197, 160, 89, 0.2);
        }

        .btn-outline-gold {
            border: 1px solid rgba(0, 0, 0, 0.08);
            color: var(--text-dark);
            font-weight: 500;
            padding: 16px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            background: #fafaf7;
            border-radius: 14px;
        }

        .photo-upload-zone {
            border: 1px dashed rgba(197, 160, 89, 0.4);
            background: #fafaf7;
            border-radius: 16px;
            padding: 35px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .photo-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(75px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .photo-preview-item {
            width: 100%;
            height: 75px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid rgba(197, 160, 89, 0.15);
        }

        .btn-gold-submit { 
            background: var(--gold-gradient); 
            color: var(--white); 
            font-weight: 600; 
            border: none; 
            border-radius: 14px; 
            width: 100%; 
            padding: 16px; 
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            transition: all 0.3s; 
            margin-top: 15px;
            box-shadow: 0 10px 25px rgba(197, 160, 89, 0.15);
        }

        /* ==========================================================================
           LOGIQUE RESPONSIVE (CONSERVATION STRICTE DE TES PROPRIÉTÉS INITIALES)
           ========================================================================== */

        /* 💻 ENSEMBLE DES GRANDS ÉCRANS / ORDINATEURS */
        @media screen and (min-width: 1025px) {
            .dashboard-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 25px 55px rgba(0, 0, 0, 0.3);
            }
        }

        /* 📋 TABLETTES (De 768px à 1024px) */
        @media screen and (max-width: 1024px) {
            .hero-section {
                height: 300px;
            }
            .hero-title h1 {
                font-size: 2.6rem;
            }
            .main-content {
                max-width: 90%; /* Donne un peu plus d'espace sur les côtés */
                padding: 0 15px 60px 15px;
            }
        }

        /* 📱 SMARTPHONES (Moins de 768px) */
        @media screen and (max-width: 767px) {
            .hero-section {
                height: 240px;
            }
            .hero-title {
                margin-top: 0;
            }
            .hero-title h1 {
                font-size: 1.8rem; /* Ajustement pour éviter que le texte ne déborde horizontalement */
                letter-spacing: 2px;
                padding: 0 10px;
            }
            .hero-title p {
                font-size: 0.65rem;
                letter-spacing: 4px;
            }
            .main-content {
                margin-top: -45px; /* Légère réduction pour l'effet de chevauchement sur mobile */
                max-width: 100%;
                padding: 0 12px 40px 12px;
            }
            .dashboard-card {
                padding: 1.5rem 1.2rem; /* Allègement du padding interne pour maximiser la zone d'écriture */
                border-radius: 20px;
                margin-bottom: 20px;
            }
            .card-heading {
                margin-bottom: 1.4rem;
                font-size: 0.75rem;
            }
            .form-control, .form-select {
                padding: 12px 14px;
                font-size: 0.85rem;
            }
            .btn-outline-gold {
                padding: 12px;
                font-size: 0.8rem;
                border-radius: 12px;
            }
            .photo-upload-zone {
                padding: 25px 15px;
            }
            .photo-preview-container {
                grid-template-columns: repeat(auto-fill, minmax(65px, 1fr));
                gap: 8px;
            }
            .photo-preview-item {
                height: 65px;
            }
            .btn-gold-submit {
                padding: 14px;
                font-size: 0.8rem;
                border-radius: 12px;
            }
        }

        /* 📳 TRÈS PETITS ÉCRANS (Moins de 360px - ex: Anciens terminaux ou iPhone compacts) */
        @media screen and (max-width: 359px) {
            .hero-title h1 {
                font-size: 1.5rem;
            }
            .dashboard-card {
                padding: 1rem;
            }
        }
</style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-image" id="parallax"></div>
        <div class="hero-overlay"></div>
        <div class="hero-title">
            <h1>WedDream</h1>
            <p>R.S.V.P. d'Exception</p>
        </div>
    </div>

    <main class="main-content">
        
        <div class="dashboard-card text-center py-4" style="border-left: 4px solid var(--gold-solid);">
            <span class="text-muted small text-uppercase tracking-wider" style="font-size: 0.7rem;">Invitation Personnelle</span>
            <h4 class="mt-2 mb-0 fw-normal" style="color: var(--text-dark); letter-spacing: 0.5px;">Cher(e) <span class="fw-semibold" style="color: var(--gold-solid);">{{ $invitation->guest_name }}</span></h4>
            <small class="text-muted d-block mt-1">Votre invitation est valable pour <strong>{{ $invitation->access_count }}</strong> personne(s)</small>
        </div>

        <form action="{{ route('guest.rsvp.submit', $invitation->link_token) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="dashboard-card">
                <div class="card-heading">
                    <i class="bi bi-heart-fill"></i>
                    <span>Votre Présence</span>
                </div>
                
                <p class="text-muted text-center small mb-4">Aura-t-on la joie de célébrer cette journée à vos côtés ?</p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <input type="radio" class="btn-check" name="rsvp_status" id="status_yes" value="confirme" onchange="toggleRsvpFields()" {{ $invitation->rsvp_status === 'confirme' ? 'checked' : '' }} required>
                    <label class="btn btn-outline-gold flex-grow-1 py-3" for="status_yes">
                        <i class="bi bi-check2 me-2"></i>Je confirme ma présence
                    </label>

                    <input type="radio" class="btn-check" name="rsvp_status" id="status_no" value="decline" onchange="toggleRsvpFields()" {{ $invitation->rsvp_status === 'decline' ? 'checked' : '' }}>
                    <label class="btn btn-outline-gold flex-grow-1 py-3" for="status_no">
                        <i class="bi bi-x-lg me-2"></i>Je décline avec regret
                    </label>
                </div>
            </div>

            <div id="section_present_group" style="display: {{ $invitation->rsvp_status === 'confirme' ? 'block' : 'none' }};">
                
                <div class="dashboard-card">
                    <div class="card-heading">
                        <i class="bi bi-glass-throat"></i>
                        <span>Rafraîchissement d'Honneur</span>
                    </div>
                    <p class="text-muted small mb-3">Veuillez sélectionner le choix de boisson de chaque convive :</p>
                    
                    @for ($i = 0; $i < $invitation->access_count; $i++)
                        <div class="mb-3 p-3 rounded-3" style="background-color: rgba(197, 160, 89, 0.05); border: 1px solid rgba(197, 160, 89, 0.1);">
                            <label class="form-label fw-semibold" for="preorder_drink_{{ $i }}">
                                <i class="bi bi-person-fill text-muted me-1"></i> Boisson de l'invité {{ $i + 1 }}
                            </label>
                            <select name="preorder_drink[]" id="preorder_drink_{{ $i }}" class="form-select drink-select-field">
                                <option value="">-- Choisir une boisson --</option>
                                @forelse($drinks as $drink)
                                    <option value="{{ $drink->name }}">{{ $drink->name }}</option>
                                @empty
                                    <option value="Sélection standard">Sélection Prestige de l'établissement</option>
                                @endforelse
                            </select>
                        </div>
                    @endfor
                </div>

                <div class="dashboard-card">
                    <div class="card-heading">
                        <i class="bi bi-camera-fill"></i>
                        <span>Partage de Photos en Direct</span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Envoyez vos plus beaux clichés durant la fête</label>
                        <div class="photo-upload-zone" onclick="document.getElementById('gallery_photos').click()">
                            <i class="bi bi-images text-muted fs-3 d-block mb-2"></i>
                            <span class="text-muted small d-inline-block fw-normal">Prenez une photo en direct ou explorez vos albums</span>
                            <input type="file" name="photos[]" id="gallery_photos" class="d-none" multiple accept="image/*" onchange="previewImages(this)">
                        </div>
                        <div class="photo-preview-container" id="previewContainer"></div>
                    </div>
                </div>

            </div>

            <div id="section_decline" class="dashboard-card" style="display: {{ $invitation->rsvp_status === 'decline' ? 'block' : 'none' }};">
                <div class="card-heading">
                    <i class="bi bi-chat-square-text-fill"></i>
                    <span>Votre Message</span>
                </div>
                <div class="mb-2">
                    <label class="form-label" for="decline_reason">Souhaitez-vous adresser un mot doux aux mariés ?</label>
                    <textarea name="decline_reason" id="decline_reason" rows="3" class="form-control" placeholder="Votre tendre message leur sera transmis directement en coulisses...">{{ old('decline_reason', $invitation->decline_reason) }}</textarea>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-heading">
                    <i class="bi bi-pen-fill"></i>
                    <span>Livre d'or Numérique</span>
                </div>
                <div class="mb-2">
                    <label class="form-label" for="wedding_wish">Laissez vos vœux de bonheur pour le couple</label>
                    <textarea name="wedding_wish" id="wedding_wish" rows="4" class="form-control" placeholder="Écrivez ici un message chaleureux qui restera gravé dans leurs souvenirs...">{{ old('wedding_wish', $invitation->wedding_wish) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn-gold-submit btn-lg">
                <i class="bi bi-send-fill me-2"></i> Transmettre ma réponse
            </button>
        </form>
    </main>

    <script>
        function toggleRsvpFields() {
            const isComing = document.getElementById('status_yes').checked;
            const isDeclining = document.getElementById('status_no').checked;

            document.getElementById('section_present_group').style.display = isComing ? 'block' : 'none';
            document.getElementById('section_decline').style.display = isDeclining ? 'block' : 'none';

            document.querySelectorAll('.drink-select-field').forEach(select => {
                select.required = isComing;
            });
        }

        function previewImages(input) {
            const container = document.getElementById('previewContainer');
            container.innerHTML = ''; 
            
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('photo-preview-item');
                        container.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</body>
</html>