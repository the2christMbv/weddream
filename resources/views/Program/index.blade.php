<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Programme | WedDream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap');

        body {
            background-color: #f8f9fa;
            background-image: linear-gradient(30deg, #ffffff 12%, transparent 12.5%, transparent 87%, #ffffff 87.5%, #ffffff), linear-gradient(150deg, #ffffff 12%, transparent 12.5%, transparent 87%, #ffffff 87.5%, #ffffff), linear-gradient(30deg, #ffffff 12%, transparent 12.5%, transparent 87%, #ffffff 87.5%, #ffffff), linear-gradient(150deg, #ffffff 12%, transparent 12.5%, transparent 87%, #ffffff 87.5%, #ffffff), linear-gradient(60deg, #f1f1f1 25%, transparent 25.5%, transparent 75%, #f1f1f1 75%, #f1f1f1), linear-gradient(60deg, #f1f1f1 25%, transparent 25.5%, transparent 75%, #f1f1f1 75%, #f1f1f1);
            background-size: 80px 140px;
            background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        .banner-program {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: clamp(50px, 8vw, 85px) 20px clamp(75px, 10vw, 110px) 20px;
            color: white;
            text-align: center;
            position: relative;
        }

        .banner-program h1 {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            letter-spacing: clamp(2px, 1vw, 5px);
            text-transform: uppercase;
            font-size: clamp(1.8rem, 4vw, 3rem);
        }
        
        .banner-program p {
            font-size: clamp(0.9rem, 1.8vw, 1.25rem);
        }

        .btn-banner-back {
            position: absolute;
            top: 25px;
            left: 25px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            font-family: 'Cinzel', serif;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            text-decoration: none;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }

        @media(min-width: 992px) {
            .btn-banner-back:hover {
                background: #d4af37;
                color: white;
                border-color: #d4af37;
                box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
            }
        }

        .card-event {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        @media(min-width: 992px) {
            .card-event:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            }
        }

        .card-header-custom {
            padding: 1.25rem 1.5rem;
            border-bottom: none;
            display: flex;
            align-items: center;
            color: white;
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .btn-save {
            background: #1a1a1a;
            color: #d4af37;
            border: 2px solid #d4af37;
            padding: 14px clamp(25px, 5vw, 50px);
            font-family: 'Cinzel', serif;
            letter-spacing: 2px;
            transition: 0.3s;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .btn-save:hover {
            background: #d4af37;
            color: white;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #6c757d;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .table-prestige {
            font-size: 0.95rem;
        }

        .table-prestige th {
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        
        .badge-venue {
            background: rgba(212, 175, 55, 0.1);
            color: #b38728;
            border: 1px solid rgba(212, 175, 55, 0.2);
            white-space: normal;
            text-align: left;
        }

        /* Ajustements de marges et d'alignement Mobile */
        .custom-offset-top {
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 767.98px) {
            .btn-return-mobile {
                position: static !important;
                margin: 0 auto 15px auto !important;
                display: inline-flex !important;
                border-radius: 8px !important;
            }
            .custom-offset-top {
                margin-top: -25px;
            }
        }
    </style>
</head>
<body>

    <section class="banner-program">
        <a href="{{ route('client.dashboard') }}" class="btn-banner-back btn-return-mobile">
            <i class="bi bi-arrow-left me-2"></i> Dashboard
        </a>

        <div>
            <h1>Le Programme</h1>
            <p class="lead">Définissez les moments forts de votre union</p>
        </div>
    </section>

    <div class="container custom-offset-top pb-5 px-3">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                @php
                    $configs = [
                        'coutumier' => ['title' => 'Mariage Coutumier', 'icon' => 'house-heart', 'bg' => '#634133'],
                        'civil'     => ['title' => 'Mariage Civil', 'icon' => 'bank', 'bg' => '#2c3e50'],
                        'religieux' => ['title' => 'Mariage Religieux', 'icon' => 'church', 'bg' => '#b38728'],
                        'soiree'    => ['title' => 'Soirée Dansante', 'icon' => 'music-note-beamed', 'bg' => '#4a148c']
                    ];
                @endphp

                <form action="{{ route('wedding.program.store', $wedding->id) }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        @foreach($configs as $type => $config)
                        <div class="col-12 col-md-6">
                            <div class="card card-event h-100">
                                <div class="card-header-custom" style="background-color: {{ $config['bg'] }}">
                                    <div class="icon-circle"><i class="bi bi-{{ $config['icon'] }}"></i></div>
                                    <h5 class="mb-0 fw-bold">{{ $config['title'] }}</h5>
                                </div>
                                <div class="card-body p-4">
                                    <input type="hidden" name="programs[{{ $type }}][type]" value="{{ $type }}">
                                    
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-6 mb-2">
                                            <label class="form-label">Date</label>
                                            <input type="date" name="programs[{{ $type }}][event_date]" 
                                                   class="form-control py-2 shadow-sm" style="border-radius: 10px;"
                                                   value="{{ $wedding->programs->where('type', $type)->first()->event_date ?? '' }}">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-2">
                                            <label class="form-label">Heure</label>
                                            <input type="time" name="programs[{{ $type }}][event_time]" 
                                                   class="form-control py-2 shadow-sm" style="border-radius: 10px;"
                                                   value="{{ $wedding->programs->where('type', $type)->first()->event_time ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Lieu de la cérémonie</label>
                                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt text-muted"></i></span>
                                            <input type="text" name="programs[{{ $type }}][venue_name]" 
                                                   class="form-control border-start-0 py-2" 
                                                   placeholder="Nom du lieu ou salle"
                                                   value="{{ $wedding->programs->where('type', $type)->first()->venue_name ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4 pt-2">
                        <button type="submit" class="btn btn-save shadow-sm">
                            ENREGISTRER LE PROGRAMME <i class="bi bi-check2-circle ms-1"></i>
                        </button>
                    </div>
                </form>

                <div class="card card-event mt-5 border-0 shadow-sm">
                    <div class="card-header-custom" style="background-color: #1a1a1a; border-bottom: 2px solid #d4af37;">
                        <div class="icon-circle" style="color: #d4af37;"><i class="bi bi-calendar-check"></i></div>
                        <h5 class="mb-0 fw-bold" style="font-family: 'Cinzel', serif; color: #d4af37;">Récapitulatif Enregistré</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle table-prestige">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase small fw-bold">Événement</th>
                                        <th class="py-3 text-uppercase small fw-bold">Date & Heure</th>
                                        <th class="py-3 text-uppercase small fw-bold">Lieu</th>
                                        <th class="pe-4 py-3 text-end text-uppercase small fw-bold">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($wedding->programs as $program)
                                        @if(!empty($program->event_date) || !empty($program->venue_name))
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <span class="fw-bold text-dark">
                                                    {{ $configs[$program->type]['title'] ?? ucfirst($program->type) }}
                                                </span>
                                            </td>
                                            <td class="py-3 text-muted small" style="white-space: nowrap;">
                                                <i class="bi bi-calendar3 me-1"></i> 
                                                {{ $program->event_date ? \Carbon\Carbon::parse($program->event_date)->format('d/m/Y') : 'Non définie' }} 
                                                <span class="mx-1">|</span>
                                                <i class="bi bi-clock me-1"></i> 
                                                {{ $program->event_time ?? '--:--' }}
                                            </td>
                                            <td class="py-3">
                                                @if(!empty($program->venue_name))
                                                    <span class="badge badge-venue px-3 py-2 rounded-2 fw-normal">
                                                        <i class="bi bi-geo-alt-fill me-1"></i> {{ $program->venue_name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">Non spécifié</span>
                                                @endif
                                            </td>
                                            <td class="pe-4 py-3 text-end">
                                                <span class="text-success small fw-bold" style="white-space: nowrap;">
                                                    <i class="bi bi-patch-check-fill me-1"></i> VALIDÉ
                                                </span>
                                            </td>
                                        </tr>
                                        @endif
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted small">
                                            <i class="bi bi-journal-x display-4 d-block mb-3 opacity-25"></i>
                                            Aucun programme n'a encore été enregistré.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>