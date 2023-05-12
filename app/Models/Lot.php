<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPE = [
        'AP' => 'Appartement',
        'MA' => 'Maison',
        'AC' => 'Local-activité',
        'CO' => 'Commerce',
        'TE' => 'Terrain',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
