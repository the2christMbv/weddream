<div style="font-family: 'Playfair Display', serif; color: #111827; padding: 40px; background: #fdfbf7;">
    <h1 style="color: #c5a059;">Félicitations {{ $member->name }} !</h1>
    <p>Vous avez été invité à rejoindre l'équipe de prestige pour le mariage de :</p>
    <h2 style="font-style: italic;">{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</h2>
    
    <div style="background: white; padding: 20px; border-radius: 15px; border: 1px solid #c5a059;">
        <p><strong>Votre Rôle :</strong> {{ ucfirst($member->role) }}</p>
        <p><strong>Vos Identifiants de connexion :</strong></p>
        <ul style="list-style: none; padding: 0;">
            <li>Email : <strong>{{ $member->email }}</strong></li>
            <li>Mot de passe temporaire : <strong>{{ $password }}</strong></li>
        </ul>
    </div>

    <p style="margin-top: 30px;">
        <a href="{{ route('login') }}" style="background: #c5a059; color: white; padding: 12px 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
            Accéder à mon interface
        </a>
    </p>
    
    <footer style="margin-top: 50px; font-size: 0.8em; color: #999;">
        Ceci est un message automatique de WedDream Exclusive.
    </footer>
</div>