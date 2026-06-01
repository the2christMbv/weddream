<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingTable extends Model
{
    use HasFactory;

    protected $table = 'wedding_tables'; 

    protected $fillable = [
        'wedding_id',
        'name',
        'capacity',
    ];

    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class, 'wedding_id');
    }

    public function invitations(): HasMany 
    {
        return $this->hasMany(Invitation::class, 'wedding_table_id');
    }
}