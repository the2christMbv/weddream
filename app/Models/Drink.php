<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    // Autorise le remplissage de ces champs
    protected $fillable = ['wedding_id', 'name', 'category'];

    /**
     * Une boisson appartient à un mariage
     */
    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}