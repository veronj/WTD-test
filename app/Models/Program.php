<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = [];

    const MARKET_STATUS = [
        'Avant-première',
        'Grande ouverture',
        'Nouveauté',
        'Démarrage des travaux',
        'En travaux',
        'Livraison immédiate',
    ];

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }


}
