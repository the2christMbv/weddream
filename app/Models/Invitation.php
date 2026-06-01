<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- CORRECTION 1 : L'import indispensable

class Invitation extends Model
{
    // CORRECTION 2 : Ajout de 'wedding_table_id', 'is_seated' et 'is_served' dans le fillable
    protected $fillable = [
        'wedding_id',
        'wedding_table_id', // <-- IMPORTANT : Permet de lier la table à l'invitation
        'guest_name',
        'type',
        'access_count',
        'phone',
        'link_token',
        'rsvp_status',
        'preorder_drink',
        'wedding_wish',
        'decline_reason',
        'guest_photos', 
        'is_seated',        // 🔥 CORRECTION : Autorise l'enregistrement du statut assis
        'is_served',        // 🔥 CORRECTION : Autorise l'enregistrement du statut boisson servie
    ];

    /**
     * Caster la colonne pour que Laravel la lise comme un tableau.
     */
    protected function casts(): array
    {
        return [
            'guest_photos' => 'array',
            'preorder_drink' => 'array', // <-- SÉCURITÉ : Indispensable pour que le superviseur voie les boissons !
            'is_seated' => 'boolean',    // OPTIONNEL : Force Laravel à le lire comme un vrai vrai Vrai/Faux
            'is_served' => 'boolean',    // OPTIONNEL : Force Laravel à le lire comme un vrai vrai Vrai/Faux
        ];
    }

    /**
     * Relation inverse : Une invitation appartient à une table de mariage.
     */
    public function weddingTable(): BelongsTo
    {
        return $this->belongsTo(WeddingTable::class, 'wedding_table_id');
    }

    /**
     * Relation avec le mariage (Utile pour le welcome et le RSVP)
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class, 'wedding_id');
    }
}