<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WedDream | Liste des Magazines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap');
        :root { --wed-gold: #c5a059; --wed-dark: #0f172a; --wed-sidebar: #1e293b; --wed-bg: #f8fafc; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--wed-bg); color: var(--wed-dark); }
        .sidebar { background: var(--wed-sidebar); min-height: 100vh; position: fixed; z-index: 100; }
        .nav-link { color: rgba(255,255,255,0.6); border-radius: 12px; padding: 12px 15px; margin-bottom: 8px; transition: all 0.3s ease; text-decoration: none; }
        .nav-link:hover, .nav-link.active { background: rgba(197, 160, 89, 0.1); color: var(--wed-gold) !important; }
        .main-content { margin-left: 16.666667%; min-height: 100vh; padding: 2rem; }
        .wedding-card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; transition: transform 0.3s; box-shadow: 0 10px 25px rgba(0,0,0,0.01); }
        .wedding-card:hover { transform: translateY(-5px); }
        .wedding-title { font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-md-2 sidebar p-4 d-flex flex-column">
                <div class="text-center mb-5">
                    <img src="{{ asset('logo-removebg-preview.png') }}" class="img-fluid" style="filter: brightness(0) invert(1);" alt="Logo">
                    <div class="mt-3 small text-uppercase" style="color: var(--wed-gold); letter-spacing: 2px;">Excellence Admin</div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-fill me-3"></i> Dashboard</a>
                    <a class="nav-link" href="#"><i class="bi bi-heart-fill me-3"></i> Mariages</a>
                    <a class="nav-link active" href="{{ route('admin.magazine.index') }}"><i class="bi bi-book-half me-3"></i> Magazine Souvenir</a>
                    <a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-3"></i> Profil</a>
                </nav>
            </div>

            <div class="col-md-10 main-content">
                <div class="mb-5">
                    <h2 class="fw-bold">Magazines Souvenirs</h2>
                    <p class="text-muted">Sélectionnez un événement pour consulter son Livre d'Or, voir ses messages et télécharger les photos.</p>
                </div>

                <div class="row g-4">
                    @forelse($weddings as $w)
                        <div class="col-md-6 col-lg-4">
                            <div class="card wedding-card h-100 p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge bg-gold-subtle text-dark mb-2" style="background-color: rgba(197, 160, 89, 0.1); color: var(--wed-gold);">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $w->reception_date ? \Carbon\Carbon::parse($w->reception_date)->format('d/m/Y') : 'Non planifié' }}
                                    </span>
                                    <h3 class="wedding-title mt-2 mb-3">{{ $w->bride_name }} & {{ $w->groom_name }}</h3>
                                    <p class="text-muted small"><i class="bi bi-chat-left-heart me-2"></i>{{ $w->invitations_count }} contribution(s) reçue(s)</p>
                                </div>
                                <div class="pt-3 border-top mt-4">
                                    <a href="{{ route('admin.magazine.show', $w->id) }}" class="btn btn-sm w-100 text-white rounded-3 py-2" style="background-color: var(--wed-dark);">
                                        Ouvrir le Livre d'Or <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="bi bi-folder-x fs-1"></i>
                            <h4 class="mt-3">Aucun mariage enregistré pour le moment.</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>