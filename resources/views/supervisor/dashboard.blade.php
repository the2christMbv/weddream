<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WedDream | Superviseur Prestige</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gold-gradient: linear-gradient(135deg, #c5a059 0%, #f1d394 50%, #c5a059 100%);
            --royal-blue: #0a192f;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --luxury-gold: #c5a059;
        }

        body {
            background-color: #fdfbf7;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--royal-blue);
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            height: 450px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--royal-blue);
        }

        .hero-image {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 140%;
            background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=2070');
            background-size: cover;
            background-position: center;
            z-index: 1;
            opacity: 0.6;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(10, 25, 47, 0.8));
            z-index: 2;
        }

        .hero-title {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
        }

        .hero-title h1 {
            font-family: 'Cinzel Decorative', serif;
            font-size: 3.5rem;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .main-content {
            position: relative;
            z-index: 10;
            margin-top: -80px;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            padding: 2.5rem;
        }

        .btn-gold-luxe {
            background: var(--gold-gradient);
            color: var(--royal-blue);
            border: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-gold-luxe:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.3);
            color: var(--royal-blue);
        }

        .input-luxury {
            background: white !important;
            border: 1px solid #eee !important;
            border-radius: 14px !important;
            padding: 10px 15px !important;
            transition: 0.3s !important;
        }

        .input-luxury:focus {
            border-color: var(--luxury-gold) !important;
            box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1) !important;
        }

        .guest-row { transition: all 0.2s; border-bottom: 1px solid #f0f0f0; }
        .guest-row:hover { background-color: rgba(197, 160, 89, 0.05) !important; }

        #reader {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            display: none;
            margin-bottom: 20px;
        }

        .drink-badge {
            background-color: rgba(197, 160, 89, 0.1);
            color: #bfa15f;
            border: 1px solid rgba(197, 160, 89, 0.3);
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .member-card {
            background: white;
            border-radius: 20px;
            padding: 15px 20px;
            border: 1px solid rgba(197, 160, 89, 0.1);
            margin-bottom: 12px;
            transition: 0.3s;
        }

        .member-card:hover {
            border-color: var(--luxury-gold);
            box-shadow: 0 10px 25px rgba(197, 160, 89, 0.05);
        }

        .icon-badge {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .staff-scroll::-webkit-scrollbar { width: 5px; }
        .staff-scroll::-webkit-scrollbar-track { background: transparent; }
        .staff-scroll::-webkit-scrollbar-thumb { background: var(--luxury-gold); border-radius: 10px; }

        @media print { .no-print { display: none !important; } }

        /* ==========================================================================
           AJOUTS RESPONSIVE (SANS MODIFICATION DE TES RÈGLES DE BASE)
           ========================================================================== */

        /* 💻 ORDINATEURS ET GRANDS ÉCRANS (Optimisation de la largeur maximale) */
        @media screen and (min-width: 1200px) {
            .main-content {
                max-width: 1140px;
                margin-left: auto;
                margin-right: auto;
            }
        }

        /* 📋 TABLETTES (iPad, Surfaces, etc. - de 768px à 1024px) */
        @media screen and (max-width: 1024px) {
            .hero-section {
                height: 380px;
            }
            .hero-title h1 {
                font-size: 2.8rem;
            }
            .main-content {
                margin-top: -60px;
                padding: 0 20px;
            }
            .glass-card {
                padding: 2rem;
                border-radius: 24px;
            }
        }

        /* 📱 SMARTPHONES (Écrans verticaux - moins de 768px) */
        @media screen and (max-width: 767px) {
            .hero-section {
                height: 280px;
            }
            .hero-title h1 {
                font-size: 1.8rem;
                padding: 0 15px;
                line-height: 1.3;
            }
            .main-content {
                margin-top: -40px;
                padding: 0 12px;
            }
            .glass-card {
                padding: 1.5rem 1rem;
                border-radius: 20px;
            }
            
            /* Rendre les tableaux responsives (au cas où tu utilises .guest-row dans un <table>) */
            .table-responsive {
                border: none;
                margin-bottom: 0;
            }

            /* Flexibilisation des cartes de membres pour les petits écrans */
            .member-card {
                padding: 12px 15px;
            }
            
            /* Ajustement des contrôles de formulaires */
            .input-luxury {
                padding: 12px !important;
                font-size: 0.95rem;
            }
            
            .btn-gold-luxe {
                width: 100%; /* Force les boutons principaux en pleine largeur sur mobile */
                padding: 12px;
            }
        }
        .hero-section {
    position: relative; /* Indispensable pour le positionnement absolu du bouton */
}

.logout-wrapper {
    position: absolute;
    top: 25px;
    right: 25px;
    z-index: 100; /* Permet de passer au-dessus de l'overlay */
}

.btn-logout-luxe {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #f1d394;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 8px 18px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.btn-logout-luxe:hover {
    background: linear-gradient(135deg, #c5a059 0%, #f1d394 50%, #c5a059 100%);
    color: #0a192f;
    border-color: transparent;
    box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
    transform: translateY(-2px);
}

/* Version Mobile */
@media screen and (max-width: 767px) {
    .logout-wrapper {
        top: 15px;
        right: 15px;
    }
    .btn-logout-luxe {
        padding: 6px 12px;
        font-size: 0.8rem;
    }
}
    </style>
</head>
<body>

    <div class="hero-section no-print">
    <!-- Emplacement et bouton Déconnexion Prestige -->
    <div class="logout-wrapper">
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <button type="submit" class="btn btn-logout-luxe shadow-sm">
                <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
            </button>
        </form>
    </div>

    <div class="hero-image" id="parallax"></div>
    <div class="hero-overlay"></div>
    <div class="hero-title">
        <h1 class="animate__animated animate__fadeInDown">WedDream</h1>
        <p class="lead fw-light text-white-50">Direction des Opérations | {{ $wedding->title ?? 'Prestige Event' }}</p>
    </div>
</div>

    <main class="container main-content mb-5">
        
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3 no-print">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-3 no-print">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="row g-3 mb-4 no-print">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold">TOTAL INVITÉS</h6>
                    <h3 class="fw-bold m-0">{{ $guests->sum('access_count') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold text-success">PRÉSENTS (SCAN)</h6>
                    <h3 class="fw-bold m-0">{{ $guests->where('is_checked_in', true)->sum('access_count') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold text-warning">CONFIRMÉS (RSVP)</h6>
                    <h3 class="fw-bold m-0">{{ $guests->where('rsvp_status', 'confirme')->sum('access_count') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center">
                    <h6 class="text-muted small fw-bold text-info">TABLES</h6>
                    <h3 class="fw-bold m-0">{{ $tables->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4 no-print">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 text-uppercase tracking-wider" style="font-size: 0.9rem;">
                        <i class="bi bi-plus-circle-fill text-warning me-2"></i>Ajouter une Boisson Prestige
                    </h5>
                    <form action="{{ route('supervisor.drinks.store', $wedding->id ?? 1) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">NOM DE LA BOISSON</label>
                            <input type="text" name="name" class="form-control py-2 rounded-3" placeholder="ex: Champagne Moët, Coca-Cola..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">CATÉGORIE DE SERVICE</label>
                            <select name="category" class="form-select py-2 rounded-3" required>
                                <option value="Champagne">Champagne</option>
                                <option value="Vin d'Honneur">Vin d'Honneur</option>
                                <option value="Cocktail">Cocktail</option>
                                <option value="Bière Premium">Bière Premium</option>
                                <option value="Soft / Sans Alcool">Soft / Sans Alcool</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-gold-luxe w-100 py-2 rounded-3 fw-bold">
                            <i class="bi bi-save2-fill me-2"></i>Mettre à disposition
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100" style="max-height: 290px; overflow-y: auto;">
                    <h5 class="fw-bold mb-3 text-uppercase tracking-wider" style="font-size: 0.9rem;">
                        <i class="bi bi-wine-glass-fill text-warning me-2"></i>Carte des Boissons Actuelles
                    </h5>
                    <div class="list-group list-group-flush">
    @forelse($wedding->drinks ?? [] as $drink)
        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
            <div>
                <span class="fw-bold text-dark d-block" style="font-size: 0.95rem;">{{ $drink->name }}</span>
                <span class="drink-badge mt-1 d-inline-block">{{ $drink->category }}</span>
            </div>
            
            <span class="badge bg-light text-secondary border rounded-pill px-3 py-2 small fw-normal">
                Choisie 
                {{ $guests->sum(function($guest) use ($drink) {
                    if (empty($guest->preorder_drink)) {
                        return 0;
                    }
                    
                    // Cas 1 : Enregistré sur place par le serveur (Chaîne de caractères)
                    if (is_string($guest->preorder_drink)) {
                        $drinksArray = array_map('trim', explode(',', $guest->preorder_drink));
                        return count(array_keys($drinksArray, $drink->name));
                    }
                    
                    // Cas 2 : Choisi via le formulaire RSVP (Tableau / JSON)
                    if (is_array($guest->preorder_drink)) {
                        return count(array_keys($guest->preorder_drink, $drink->name));
                    }

                    return 0;
                }) }} fois
            </span>
        </div>
    @empty
        <div class="text-center py-4 text-muted small fw-light">
            <i class="bi bi-info-circle d-block mb-2 fs-4 text-warning"></i>
            Aucune boisson enregistrée pour le moment.
        </div>
    @endforelse
</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4 no-print">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 text-uppercase tracking-wider" style="font-size: 0.85rem; font-family: 'Plus Jakarta Sans', sans-serif; color: var(--royal-blue);">
                        <i class="bi bi-person-plus-fill text-warning me-2"></i>Nouvelle affectation équipe
                    </h5>
                    <form action="{{ route('supervisor.staff.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold text-muted mb-1 text-uppercase" style="font-size: 0.7rem;">Nom du Collaborateur</label>
                            <input type="text" name="name" class="form-control input-luxury" placeholder="ex: Antoine Kabeya" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted mb-1 text-uppercase" style="font-size: 0.7rem;">Numéro WhatsApp</label>
                            <input type="tel" name="phone" class="form-control input-luxury" placeholder="ex: 243..." required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted mb-1 text-uppercase" style="font-size: 0.7rem;">Email Professionnel</label>
                            <input type="email" name="email" class="form-control input-luxury" placeholder="staff@weddream.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted mb-1 text-uppercase" style="font-size: 0.7rem;">Rôle Assigné</label>
                            <select name="role" class="form-select input-luxury">
                                <option value="server">Maître de Table (Service Or)</option>
                                <option value="supervisor">Superviseur</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-gold-luxe w-100 py-2 rounded-3 fw-bold mt-2" style="font-size:0.85rem; letter-spacing:1px;">
                            Valider l'adhésion <i class="bi bi-check2-all ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0 text-uppercase tracking-wider" style="font-size: 0.85rem;">
                <i class="bi bi-shield-lock-fill text-warning me-2"></i>Effectif Actuel Équipe
            </h5>
            <span class="badge bg-light text-dark border rounded-pill px-3 py-1.5 small fw-bold">
                {{ count($staff ?? []) }} Membres
            </span>
        </div>

        <div class="staff-scroll" style="max-height: 290px; overflow-y: auto; padding-right: 5px;">
            @forelse($staff ?? [] as $member)
                <div class="member-card d-flex align-items-center justify-content-between shadow-sm bg-white border-start border-4 {{ $member->role == 'supervisor' ? 'border-primary' : 'border-warning' }}">
                    <div class="d-flex align-items-center">
                        <div class="icon-badge {{ $member->role == 'supervisor' ? 'bg-primary text-white' : 'bg-warning text-dark' }} shadow-sm me-3">
                            <i class="bi {{ $member->role == 'supervisor' ? 'bi-shield-check' : 'bi-cup-straw' }}"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size:0.9rem;">{{ $member->name }}</h6>
                                @if($member->role == 'supervisor')
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size: 0.65rem; font-weight: 600;">Superviseur</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-dominant border border-warning-subtle rounded-pill" style="font-size: 0.65rem; font-weight: 600; color: #856404; background-color: #fff3cd;">Serveur</span>
                                @endif
                            </div>
                            <div class="small text-muted" style="font-size:0.75rem;">
                                <i class="bi bi-whatsapp text-success me-1"></i>{{ $member->phone ?? 'S/N' }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-1">
                        @if($member->phone)
                            @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $member->phone);
                        
                        // On vérifie si un mot de passe vient d'être réinitialisé pour CE membre précis
                        if (session('reset_member_id') == $member->id && session('generated_password')) {
                            $passwordText = session('generated_password') . " ⚠️ (À modifier après connexion)";
                        } else {
                            $passwordText = "Celui défini lors de ton adhésion (ou contacte ton superviseur)";
                        }

                        $waMessage = "✨ *Rappel Accès Staff WedDream* ✨\n\n" .
                                    "Bonjour " . $member->name . ",\n" .
                                    "Voici tes identifiants :\n" .
                                    "📧 *Email* : " . $member->email . "\n" .
                                    "🔑 *Mot de passe* : " . $passwordText . "\n" .
                                    "🔗 *Lien* : " . url('/') . "\n\n" .
                                    "Bon service !";
                            @endphp
                            <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode($waMessage) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-light text-success rounded-3 border shadow-sm" 
                               title="Rappel WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        @endif

                        <form action="{{ route('supervisor.staff.reset', $member->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light text-dark rounded-3 border shadow-sm" title="Réinitialiser le code">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>

                        <form action="{{ route('supervisor.staff.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment retirer ce membre ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light text-danger rounded-3 border shadow-sm">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted small fw-light">
                    <i class="bi bi-people d-block mb-2 fs-4 text-warning"></i>
                    Aucun collaborateur rattaché pour le moment.
                </div>
            @endforelse
        </div>
    </div>
</div> 
        </div>

        <div class="glass-card">
    <div class="row g-3 mb-4 no-print align-items-center">
        <!-- SCANNER QR -->
  <div class="row g-3 align-items-center">
        <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 rounded-start-4 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control py-3 border-start-0 rounded-end-4 shadow-sm" placeholder="Rechercher...">
        </div>
    </div>

    <div class="col-md-4">
        <a href="{{ route('supervisor.borne.qr', ['id' => $wedding->id]) }}" target="_blank" class="btn btn-primary w-100 py-3 rounded-4 shadow-sm text-white fw-bold">
            <i class="bi bi-qr-code me-1"></i> QR Code Borne
        </a>
    </div>

    <div class="col-md-4">
        <button class="btn btn-outline-dark w-100 py-3 rounded-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddTable">
            <i class="bi bi-plus-lg me-1"></i> Table
        </button>
    </div>
    </div>
            <div id="reader" class="no-print shadow-lg bg-light"></div>

            <h5 class="fw-bold mb-4 text-uppercase tracking-wider no-print"><i class="bi bi-grid-3x3-gap-fill text-warning me-2"></i>Plan de Salle</h5>
            
            <div class="row g-3 mb-5 no-print">
    @foreach($tables as $table)
        @php
            $allocatedSeats = $table->invitations->sum('access_count');
            $isFull = $allocatedSeats >= $table->capacity;
        @endphp
        <div class="col-xl-3 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 {{ $isFull ? 'border-start border-danger border-4' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="fw-bold d-block">{{ $table->name }}</span>
                        <small class="text-muted">{{ $allocatedSeats }}/{{ $table->capacity }} places</small>
                    </div>
                    
                    <!-- Actions de la table (Imprimer & Supprimer) -->
                    <div class="d-flex align-items-center gap-1">
                        <!-- BOUTON IMPRESSION DE CETTE TABLE SPECIFIQUE -->
                        <a href="{{ route('client.staff.table.print', ['id' => $table->id]) }}" target="_blank" class="btn btn-sm text-warning" title="Imprimer le ticket A4">
                            <i class="bi bi-printer-fill" style="font-size: 1.1rem;"></i>
                        </a>

                        <!-- FORMULAIRE DE SUPPRESSION -->
                        <form action="{{ route('supervisor.tables.remove', $table->id) }}" method="POST" class="m-0">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-danger" onclick="return confirm('Retirer cette table ?')" title="Supprimer la table">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

            <h5 class="fw-bold mb-3 text-uppercase tracking-wider"><i class="bi bi-people-fill text-warning me-2"></i>Registre des Invités</h5>
            <div class="table-responsive border rounded-4 bg-white shadow-sm">
    <table class="table align-middle mb-0" id="guestsTable">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Invité & Token</th>
                <th>Catégorie</th>
                <th>Places</th>
                <th>Boisson(s) Choisie(s)</th>
                <th>Placement Salle</th>
                <th class="text-center">Pointage</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guests as $guest)
            <tr class="guest-row" id="guest-row-{{ $guest->id }}">
                <td class="ps-4">
                    <div class="fw-bold guest-name">{{ $guest->guest_name }}</div>
                    <div class="text-muted small">ID Token: {{ $guest->link_token }}</div>
                </td>
                
                <td>
                    <span class="badge bg-light text-dark border rounded-pill px-3">
                        {{ ucfirst($guest->type) }}
                    </span>
                </td>
                
                <td class="text-muted small fw-bold">
                    {{ $guest->access_count }} pers.
                </td>
                
                <td>
                    <div class="d-flex flex-column gap-2">
                        @if(!empty($guest->preorder_drink))
                            <div class="d-flex flex-column gap-1">
                                @if(is_array($guest->preorder_drink))
                                    @foreach($guest->preorder_drink as $index => $drinkName)
                                        <span class="text-dark fw-medium d-inline-flex align-items-center" style="font-size: 0.85rem;">
                                            <i class="bi bi-check2-circle text-success me-1"></i>
                                            <small class="text-muted fw-light me-1">P{{ $index + 1 }}:</small> 
                                            <span class="badge bg-light text-dark border-start border-warning border-3 rounded-1 px-2 py-0.5">
                                                {{ trim($drinkName) ?: 'Aucun choix' }}
                                            </span>
                                        </span>
                                    @endforeach
                                @else
                                    @foreach(array_filter(explode(',', $guest->preorder_drink)) as $index => $drinkName)
                                        <span class="text-dark fw-medium d-inline-flex align-items-center" style="font-size: 0.85rem;">
                                            <i class="bi bi-check2-circle text-success me-1"></i>
                                            <small class="text-muted fw-light me-1">P{{ $index + 1 }}:</small> 
                                            <span class="badge bg-light text-dark border-start border-warning border-3 rounded-1 px-2 py-0.5">
                                                {{ trim($drinkName) }}
                                            </span>
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        @else
                            <span class="text-muted small fw-light">Aucun choix</span>
                        @endif

                        @if($guest->is_checked_in)
                            <div class="mt-1">
                                <button type="button" 
                                        onclick="markAsServed({{ $guest->id }}, this)" 
                                        class="btn btn-xs {{ ($guest->is_served ?? false) ? 'btn-success' : 'btn-outline-warning' }} rounded-pill px-2 py-0.5" 
                                        style="font-size: 0.72rem; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem;"
                                        {{ ($guest->is_served ?? false) ? 'disabled' : '' }}>
                                    <i class="bi {{ ($guest->is_served ?? false) ? 'bi-cup-straw' : 'bi-hand-index-thumb' }} me-1"></i>
                                    {{ ($guest->is_served ?? false) ? 'Servi ✓' : 'Marquer Servi' }}
                                </button>
                            </div>
                        @endif
                    </div>
                </td>
                
                <td>
                    <div class="d-flex flex-column gap-2">
                        <div class="input-group input-group-sm w-auto no-print">
                            <select class="form-select rounded-3" id="table_{{ $guest->id }}" onchange="saveAssignment({{ $guest->id }}, this)">
                                <option value="">Choisir Table...</option>
                                @foreach($tables as $table)
                                    <option value="{{ $table->id }}" {{ $guest->wedding_table_id == $table->id ? 'selected' : '' }}>{{ $table->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        @if($guest->wedding_table_id)
                            <div class="text-primary fw-bold small" style="font-size: 0.75rem;">
                                Assigné : {{ $guest->weddingTable->name ?? 'Table #'.$guest->wedding_table_id }}
                            </div>

                            @if($guest->is_checked_in)
                                <div class="mt-1">
                                    <button type="button" 
                                            onclick="markAsSeated({{ $guest->id }}, this)" 
                                            class="btn btn-xs {{ ($guest->is_seated ?? false) ? 'btn-dark' : 'btn-outline-primary' }} rounded-3 px-2 py-0.5" 
                                            style="font-size: 0.72rem; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem;"
                                            {{ ($guest->is_seated ?? false) ? 'disabled' : '' }}>
                                        <i class="bi {{ ($guest->is_seated ?? false) ? 'bi-check-all' : 'bi-chair' }} me-1"></i>
                                        {{ ($guest->is_seated ?? false) ? 'Installé ✓' : 'Confirmer Assis' }}
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </td>
                
                <td class="text-center">
                    @if($guest->is_checked_in)
                        <div class="text-success d-flex flex-column align-items-center">
                            <i class="bi bi-patch-check-fill h4 mb-0"></i>
                            <small class="text-muted small" style="font-size: 0.7rem;">Présent</small>
                        </div>
                    @else
                        <form action="{{ route('supervisor.checkin', $guest->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-dark rounded-pill no-print px-3">Valider</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">Aucun invité trouvé dans la table d'invitations.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
        </div>
    </main>

    <div class="modal fade" id="modalAddTable" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle-fill text-warning me-2"></i>Nouvelle Table Prestige</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('supervisor.tables.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nom / Numéro de la Table</label>
                            <input type="text" name="name" class="form-control py-2 rounded-3" placeholder="ex: Table d'Honneur, Table 1..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Capacité (Nombre de places)</label>
                            <input type="number" name="capacity" class="form-control py-2 rounded-3" min="1" max="20" value="10" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light py-3">
                        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-dark rounded-3 px-4">Créer la table</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    // Recherche synchrone dans la table
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.guest-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });

    // Effet parallaxe sur le hero header
    window.addEventListener('scroll', function() {
        let offset = window.pageYOffset;
        let parallax = document.getElementById('parallax');
        if(parallax) parallax.style.transform = "translateY(" + (offset * 0.4) + "px)";
    });

    // Gestion de l'affectation à une table en AJAX
    async function saveAssignment(guestId, selectElement) {
        const tableId = selectElement.value;
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        try {
            const response = await fetch(`/supervisor/assign-table`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ guest_id: guestId, table_id: tableId })
            });
            
            const data = await response.json();
            if (response.ok) {
                window.location.reload();
            } else {
                alert(data.message || "Erreur lors de l'affectation.");
            }
        } catch (error) {
            console.error("Erreur:", error);
            alert("Une erreur réseau est survenue.");
        }
    }

    // Contrôle du scanner de code QR (Mis à jour et stabilisé)
    let html5QrCode;
    async function toggleScanner() {
        const readerDiv = document.getElementById('reader');
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (readerDiv.style.display === 'none' || readerDiv.style.display === '') {
            readerDiv.style.display = 'block';
            
            if (html5QrCode) {
                try { await html5QrCode.clear(); } catch(e) {}
            }

            html5QrCode = new Html5Qrcode("reader");
            try {
                await html5QrCode.start(
                    { facingMode: "environment" }, 
                    { fps: 10, qrbox: 250 }, 
                    async (decodedText) => {
                        console.log("🎯 QR Code détecté :", decodedText);

                        // Arrêt sécurisé du flux vidéo pour ne pas briser la chaîne de promesses
                        try {
                            await html5QrCode.stop();
                        } catch (stopError) {
                            console.warn("Notification arrêt flux caméra :", stopError);
                        }
                        
                        readerDiv.style.display = 'none';

                        // Extraction de l'ID si le QR code contient l'URL complète
                        let cleanText = decodedText;
                        if (decodedText.includes('/') || decodedText.includes('://')) {
                            const segments = decodedText.split('/');
                            cleanText = segments.pop() || segments.pop();
                        }

                        try {
                            console.log(`📡 Communication initiée pour l'ID : ${cleanText}`);
                            
                            const response = await fetch(`/supervisor/check-in/${cleanText}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });

                            const data = await response.json();
                            console.log("📦 Données retournées par le serveur :", data);

                            if (response.ok) {
                                // Transition visuelle verte sur la ligne correspondante de l'interface
                                const targetRow = document.getElementById(`guest-row-${cleanText}`);
                                if (targetRow) {
                                    targetRow.style.transition = "background-color 0.5s ease";
                                    targetRow.style.backgroundColor = "#d4edda";
                                }
                                
                                console.log(`✓ Présence validée pour : ${data.guest_name}`);
                                
                                // Temporisation douce avant rafraîchissement pour visualiser la validation
                                setTimeout(() => { window.location.reload(); }, 1000);
                            } else {
                                // Traitement des codes d'erreurs HTTP contrôlés (ex: 400 pour doublon)
                                alert(data.message || "La validation de ce ticket a échoué.");
                            }
                        } catch (err) {
                            console.error("❌ Défaillance lors du traitement de l'envoi :", err);
                            alert("Erreur de transfert des données ou session expirée.");
                        }
                    }
                );
            } catch (err) {
                console.error("Impossible de démarrer le scanner :", err);
                alert("Erreur d'accès à la caméra.");
                readerDiv.style.display = 'none';
            }
        } else {
            if (html5QrCode) {
                try { await html5QrCode.stop(); } catch(e) {}
            }
            readerDiv.style.display = 'none';
        }
    }

    // Fonction universelle pour confirmer que l'invité est assis
    function markAsSeated(guestId, button) {
        if(!confirm("Confirmer que cet invité est bien installé à sa table ?")) return;

        button.disabled = true;

        fetch(`/guest/set-seated/${guestId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error("Erreur de communication serveur");
            return response.json();
        })
        .then(data => {
            if(data.success) {
                button.className = "btn btn-xs btn-dark rounded-3 py-1 small";
                button.innerHTML = "<i class='bi bi-check-all me-1'></i> Installé à sa table ✓";
                
                setTimeout(() => { location.reload(); }, 600);
            } else {
                alert("Erreur : " + data.message);
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Erreur technique:', error);
            alert("Une erreur technique est survenue.");
            button.disabled = false;
        });
    }

    // Fonction universelle pour confirmer que le service de boisson est fait
    function markAsServed(guestId, button) {
        if(!confirm("Valider que la commande de boisson a bien été servie ?")) return;

        button.disabled = true;

        fetch(`/guest/set-served/${guestId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error("Erreur de communication serveur");
            return response.json();
        })
        .then(data => {
            if(data.success) {
                button.className = "btn btn-xs btn-success rounded-pill px-2 py-1 small";
                button.innerHTML = "<i class='bi bi-cup-straw me-1'></i> Boisson Servie ✓";
                
                setTimeout(() => { location.reload(); }, 600);
            } else {
                alert("Erreur : " + data.message);
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Erreur technique:', error);
            alert("Une erreur technique est survenue.");
            button.disabled = false;
        });
    }
</script>
</body>
</html>