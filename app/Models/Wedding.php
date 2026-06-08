<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wedding extends Model
{
    // Autorise l'enregistrement de ces champs via Wedding::create()
    protected $fillable = [
    'bride_name', 
    'groom_name', 
    'user_id',
    'contact_phone', 
    'guest_count_estimated',
    'max_invitations',
    'date_customary',
    'time_customary',
    'date_civil',
    'time_civil',
    'date_religious',
    'time_religious',
    'reception_date',
    'reception_time',
    'reception_location',
    'event_date',
    'cover_photo', // <--- AJOUTE CETTE LIGNE ICI
    'model_premium', // Ajoute aussi ceux-là si tu les updates via $data
    'model_vip',
    'model_group',
];

    /**
     * Relation : Un mariage appartient à un utilisateur (le compte client)
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function programs(): HasMany
    {
        return $this->hasMany(WeddingProgram::class);
    }
    public function invitations()
{
    return $this->hasMany(Invitation::class);
}
        public function drinks()
    {
        return $this->hasMany(WeddingDrink::class);
    }
    
}