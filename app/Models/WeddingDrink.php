<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingDrink extends Model
{
    use HasFactory;

    protected $fillable = ['wedding_id', 'name', 'category'];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}