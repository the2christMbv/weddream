<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',             // Si ta BDD utilise 'guest_name', remplace 'name' par 'guest_name'
        'email',
        'phone',
        'wedding_id',
        'wedding_table_id',
        'seat_number',
        'is_checked_in',
        'checked_in_at',
        // --- AJOUTS INDISPENSABLES POUR TON BLADE ---
        'access_count',     // C'est cette colonne qui stocke le nombre de places (ex: 2 pour un couple)
        'type',             // Exemple : VIP, Famille, Couple...
        'link_token',       // Le token unique pour le QR Code / Lien unique
        'preorder_drink',   // Les boissons précommandées
        'rsvp_status'       // Statut de confirmation (ex: 'confirme')
    ];

    /**
     * Cast des attributs.
     * Très important pour que 'preorder_drink' soit manipulé comme un tableau PHP
     * et 'access_count' comme un nombre entier.
     */
    protected $casts = [
        'is_checked_in' => 'boolean',
        'checked_in_at' => 'datetime',
        'access_count' => 'integer',
        'preorder_drink' => 'array', // Transforme automatiquement le JSON de la BDD en tableau PHP
    ];

    // Relation : L'invité appartient à un mariage
    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }

    // Relation : L'invité est assigné à une table
    // Ajout d'un alias 'weddingTable' pour correspondre exactement à ton fichier Blade
    public function weddingTable()
    {
        return $this->belongsTo(WeddingTable::class, 'wedding_table_id');
    }

    // Tu peux garder l'ancienne méthode au cas où elle est utilisée ailleurs
    public function table()
    {
        return $this->table();
    }
}