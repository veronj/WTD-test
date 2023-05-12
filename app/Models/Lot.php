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

    public function getSurfaceFloorAttribute()
    {
        if (in_array($this->type, ['AC', 'CO', 'TE'])) {
            return $this::TYPE[$this->type].' : '.$this->living_surface.'m²';
        }

        $floor = $this->floor;
        if ((int) $this->floor == 1) {
            $floor = '1er étage';
        } elseif ((int) $this->floor > 1) {
            $floor = $this->floor.'ème étage';
        }

        return $this::TYPE[$this->type].' : '.$this->living_surface.'m² - Etage : '.$floor;
    }

    public function theNewFunction()
    {
        //TODO make this work !
    }
}
