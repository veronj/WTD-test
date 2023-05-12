<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published_at', '>', Carbon::now());
    }

    public function scopeMarketStatus($query, $status)
    {
        return $query->where('market_status', $status);
    }

    public function programWithLotsFromParis()
    {
        return $this->where('city', 'Paris')->has('lots')->get();
    }

//create a method that returns an array of program names and city name grouped by market status.
// For example: ['Avant-première' => ['name' => 'Program 1', 'city' => 'Paris']]

    public function programGroupByMarketStatus()
    {
        $programs = $this->all();
        $array = [];
        foreach ($programs as $program) {
            $array[$program->market_status][] = ['name' => $program->name, 'city' => $program->city];
        }

        return $array;
    }

//create a method that returns the number of programs per city.

    public function programCountByCity()
    {
        $programs = $this->all();
        $array = [];
        foreach ($programs as $program) {
            $array[$program->city][] = $program->name;
        }
        foreach ($array as $key => $value) {
            $array[$key] = count($value);
        }

        return $array;
    }

//create a method that returns the number of programs per city and per market status.
// For example: ['Paris' => ['Avant-première' => 2, 'Grande ouverture' => 1], 'Lyon' => ['Avant-première' => 0, 'Grande ouverture' => 3]]

    public function programCountByCityAndMarketStatus()
    {
        $programs = $this->all();
        $array = [];
        foreach ($programs as $program) {
            $array[$program->city][$program->market_status][] = $program->name;
        }
        foreach ($array as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $array[$key][$key2] = count($value2);
            }
        }

        return $array;
    }
}
