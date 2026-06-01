<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne; // Import nécessaire

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'phone',      // Autorise l'enregistrement du téléphone
    'role',       // Autorise l'enregistrement du rôle (SUPER IMPORTANT)
    'wedding_id', // Autorise le lien avec le mariage (SINON LE TABLEAU EST VIDE)
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relation : Un utilisateur peut posséder UN mariage (le marié)
     */
    public function wedding(): HasOne
    {
        return $this->hasOne(Wedding::class, 'user_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}