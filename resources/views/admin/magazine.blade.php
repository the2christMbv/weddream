<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Édition Magazine Souvenir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alex+Brush&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap');

        :root {
            --wed-gold: #c5a059;
            --wed-dark: #0f172a;
            --wed-sidebar: #1e293b;
            --wed-bg: #f8fafc;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--wed-bg);
            color: var(--wed-dark);
            overflow-x: hidden;
        }

        .sidebar { 
            background: var(--wed-sidebar);
            min-height: 100vh; 
            position: fixed; 
            top: 0; bottom: 0; left: 0;
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            border-right: 1px solid rgba(255,255,255,0.05);
            display: none !important;
        }

        .mobile-navbar {
            background: var(--wed-sidebar);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .mobile-toggle-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1.5rem;
            padding: 4px 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .mobile-toggle-btn:hover {
            border-color: var(--wed-gold);
            color: var(--wed-gold);
        }

        .nav-link {
            color: rgba(255,255,255,0.6);
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(197, 160, 89, 0.1);
            color: var(--wed-gold) !important;
        }

        .main-content { 
            min-height: 100vh;
            padding: clamp(1.25rem, 3vw, 2.5rem);
            width: 100%;
            transition: all 0.3s ease;
        }

        .magazine-cover {
            height: clamp(250px, 40vh, 380px);
            border-radius: 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            margin-bottom: 2.5rem;
            padding: 20px;
        }

        .magazine-cover h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.8rem, 4vw, 3.5rem);
            font-weight: 400;
            letter-spacing: 2px;
        }

        .script-text {
            font-family: 'Alex Brush', cursive;
            font-size: clamp(2rem, 5vw, 3.2rem);
            color: var(--wed-gold);
        }

        .wish-card {
            background: white;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02);
            transition: transform 0.3s ease;
        }

        .wish-card:hover { transform: translateY(-5px); }

        .wish-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.2rem, 2vw, 1.4rem);
            line-height: 1.6;
            font-style: italic;
            color: #334155;
        }

        .guest-author {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            color: var(--wed-gold);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        @media(min-width: 576px) {
            .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(105px, 105px)); }
        }

        .gallery-container {
            position: relative;
            aspect-ratio: 1 / 1;
            width: 100%;
        }

        @media(min-width: 576px) {
            .gallery-container { width: 105px; height: 105px; }
        }

        .gallery-item {
            width: 100%; height: 100%;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .gallery-item:hover { transform: scale(1.03); }

        .btn-download-photo {
            position: absolute;
            top: 5px; right: 5px;
            background: rgba(15, 23, 42, 0.85);
            color: #ffffff !important;
            border: none;
            border-radius: 50%;
            width: 28px; height: 28px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            text-decoration: none;
            z-index: 10;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        .btn-download-photo:hover {
            background: var(--wed-gold);
            color: white !important;
            transform: scale(1.1);
        }

        @media (min-width: 1200px) {
            .sidebar { display: flex !important; width: 250px; }
            .main-content { margin-left: 250px; width: calc(100% - 250px); }
            .mobile-navbar { display: none !important; }
        }

        @media (min-width: 992px) and (max-width: 1199.98px) {
            .sidebar { display: flex !important; width: 220px; }
            .main-content { margin-left: 220px; width: calc(100% - 220px); }
            .mobile-navbar { display: none !important; }
        }

        @media print {
            .sidebar, .no-print, .btn-print-zone, .btn-download-photo, .mobile-navbar {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .wish-card {
                break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                margin-bottom: 25px !important;
            }
            .magazine-cover {
                height: 250px !important;
                border-radius: 0 !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar Mobile -->
    <div class="mobile-navbar no-print">
        <div class="d-flex align-items-center">
            <img src="{{ asset('logo-removebg-preview.png') }}" height="35" style="filter: brightness(0) invert(1);" alt="Logo">
            <span class="ms-2 small text-uppercase fw-bold" style="color: var(--wed-gold); letter-spacing: 1px; font-size: 0.75rem;">Admin</span>
        </div>
        <button class="mobile-toggle-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Sidebar Mobile (Offcanvas) -->
    <div class="offcanvas offcanvas-start text-bg-dark no-print" tabindex="-1" id="mobileSidebar" style="background-color: var(--wed-sidebar) !important; width: 280px;">
        <div class="offcanvas-header justify-content-end border-bottom border-secondary-subtle">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-4 d-flex flex-column">
            <div class="text-center mb-4">
                <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid px-4" style="filter: brightness(0) invert(1);" alt="Logo">
                <div class="mt-2 small text-uppercase" style="color: var(--wed-gold); letter-spacing: 2px; font-size: 0.75rem;">Excellence Admin</div>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-fill me-3"></i> Dashboard
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-heart-fill me-3"></i> Mariages
                </a>
                <a class="nav-link active" href="{{ route('admin.magazine.index') }}">
                    <i class="bi bi-book-half me-3"></i> Magazine Souvenir
                </a>
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle me-3"></i> Profil
                </a>
            </nav>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <!-- Sidebar Desktop -->
            <div class="col-12 sidebar p-4 d-flex flex-column no-print">
                <div class="text-center mb-5">
                    <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid" style="filter: brightness(0) invert(1);" alt="Logo">
                    <div class="mt-3 small text-uppercase" style="color: var(--wed-gold); letter-spacing: 2px;">Excellence Admin</div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-fill me-3"></i> Dashboard
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-heart-fill me-3"></i> Mariages
                    </a>
                    <a class="nav-link active" href="{{ route('admin.magazine.index') }}">
                        <i class="bi bi-book-half me-3"></i> Magazine Souvenir
                    </a>
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-3"></i> Profil
                    </a>
                </nav>
            </div>

            <!-- Contenu Principal -->
            <div class="main-content">
                
                <!-- Barre d'actions -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3 mb-4 no-print">
                    <a href="{{ route('admin.magazine.index') }}" class="btn btn-sm btn-light rounded-3 px-3 py-2 text-center">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                    </a>
                    <button onclick="window.print()" class="btn btn-dark rounded-3 px-4 py-2 shadow-sm">
                        <i class="bi bi-download me-2"></i> Télécharger le Magazine (PDF)
                    </button>
                </div>

                <!-- Section Statistiques Intégrée (no-print pour éviter d'imprimer ce bloc sur le PDF) -->
                <div class="row g-4 mb-4 no-print">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card border-0 rounded-4 p-4 shadow-sm" style="background: white;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase fw-bold text-muted small mb-1" style="letter-spacing: 1px;">
                                        Invitations Lancées
                                    </h6>
                                    <h2 class="fw-bold mb-0 text-dark">
                                        {{ $totalInvitations }}
                                    </h2>
                                </div>
                                <div class="rounded-circle p-3" style="background: rgba(197, 160, 89, 0.1); color: var(--wed-gold);">
                                    <i class="bi bi-envelope-paper-heart-fill fs-3"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="text-muted small">Total généré pour cet événement</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Couverture du Magazine -->
                <div class="magazine-cover" style="background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.7)), url('{{ $wedding->cover_photo ? asset('storage/' . $wedding->cover_photo) : 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070' }}') center/cover;">
                    <span class="script-text">Le Livre d'Or</span>
                    <h1>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</h1>
                    <p class="text-uppercase tracking-widest small mt-2" style="letter-spacing: 3px;">
                        <i class="bi bi-calendar3 me-2"></i>{{ $wedding->reception_date ? \Carbon\Carbon::parse($wedding->reception_date)->format('d F Y') : 'Album Souvenir' }}
                    </p>
                </div>

                <!-- Grille des Vœux -->
                <div class="row g-4">
                    @forelse($invitations as $invite)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 wish-card p-4 d-flex flex-column justify-content-between">
                                <div>
                                    @if($invite->wedding_wish)
                                        <p class="wish-text mb-4">“ {{ $invite->wedding_wish }} ”</p>
                                    @elseif($invite->decline_reason)
                                        <p class="wish-text mb-4 text-muted">“ {{ $invite->decline_reason }} ” <br><small>(Absence signalée)</small></p>
                                    @else
                                        <p class="wish-text text-muted small mb-4 italic">A partagé sa présence sans laisser de message écrit.</p>
                                    @endif
                                </div>

                                <div>
                                    @if(!empty($invite->guest_photos))
                                        <div class="gallery-grid mb-3">
                                            @foreach($invite->guest_photos as $photoPath)
                                                <div class="gallery-container">
                                                    <img src="{{ asset('storage/' . $photoPath) }}" 
                                                         class="gallery-item" 
                                                         alt="Cliché de {{ $invite->guest_name }}"
                                                         onclick="openLightbox(this.src)">
                                                    
                                                    <a href="{{ route('admin.magazine.download-photo', ['path' => $photoPath]) }}" 
                                                       class="btn-download-photo no-print" 
                                                       title="Télécharger cette image">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="border-top pt-3 mt-2 d-flex justify-content-between align-items-center">
                                        <span class="guest-author text-truncate me-2"><i class="bi bi-person me-1"></i> {{ $invite->guest_name }}</span>
                                        <span class="badge {{ $invite->rsvp_status == 'confirme' ? 'bg-success-subtle text-success' : 'bg-light text-dark' }} font-monospace small px-2 py-1" style="font-size: 0.7rem; flex-shrink: 0;">
                                            {{ $invite->rsvp_status == 'confirme' ? 'Présent' : 'Absent' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted no-print">
                            <i class="bi bi-book fs-1 d-block mb-3 text-muted" style="opacity: 0.5;"></i>
                            <h4>Aucun vœu ou photo n'a encore été soumis par les invités.</h4>
                            <p class="small">Les réponses RSVP apparaîtront automatiquement ici.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div class="modal fade no-print" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
            <div class="modal-content bg-transparent border-0 text-center">
                <div class="modal-header border-0 p-2 d-sm-none justify-content-end">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <img id="lightboxImg" src="" class="img-fluid rounded-4 shadow-lg mx-auto" style="max-height: 85vh; object-fit: contain;">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            const myModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
            myModal.show();
        }
    </script>
</body>
</html>