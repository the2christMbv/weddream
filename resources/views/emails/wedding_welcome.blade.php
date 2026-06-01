<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bienvenue chez WedDream</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #c5a059; /* Votre couleur dorée WedDream */
            color: white;
            padding: 30px text-align: center;
        }
        .content {
            padding: 30px;
            background-color: #ffffff;
        }
        .footer {
            background-color: #f8fafc;
            color: #64748b;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #c5a059;
            color: white !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            margin-top: 20px;
        }
        .credentials {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .credentials p {
            margin: 5px 0;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">WedDream</h1>
            <p style="margin: 5px 0;">Sublimer votre union</p>
        </div>

        <div class="content">
            <h2 style="color: #1e293b;">Félicitations {{ $wedding->bride_name }} & {{ $wedding->groom_name }} !</h2>
            
            <p>Nous avons le plaisir de vous annoncer que votre espace de planification personnalisé est désormais disponible sur notre plateforme.</p>
            
            <p>Cet espace vous permettra de suivre en temps réel l'évolution de vos préparatifs, de consulter votre planning (Coutumier, Civil, Religieux) et de gérer vos détails logistiques.</p>

            <div class="credentials">
                <h3 style="margin-top: 0; font-size: 16px;">Vos accès sécurisés :</h3>
                <p><strong>Email :</strong> {{ $wedding->user->email }}</p>
                <p><strong>Mot de passe provisoire :</strong> <span style="background-color: #fff; padding: 2px 5px; border: 1px solid #cbd5e1;">{{ $password }}</span></p>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('login') }}" class="btn">Accéder à mon espace</a>
            </div>

            <p style="margin-top: 30px; font-size: 14px; color: #64748b;">
                *Par mesure de sécurité, nous vous conseillons de modifier votre mot de passe dès votre première connexion.*
            </p>
        </div>

        <div class="footer">
            <p>Cet email a été envoyé par WedDream.<br>
            Kinshasa, République Démocratique du Congo.</p>
            <p>&copy; 2026 WedDream - Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>