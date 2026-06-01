<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingProgram extends Model
{
    protected $fillable = [
        'wedding_id', 
        'type', // coutumier, civil, religieux, soiree
        'event_date', 
        'event_time', 
        'venue_name', 
        'venue_address'
    ];

    /**
     * Récupère le mariage associé à ce programme.
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}