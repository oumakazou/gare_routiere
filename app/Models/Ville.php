<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function departures(): HasMany
    {
        return $this->hasMany(Voyage::class, 'ville_depart_id');
    }

    public function arrivals(): HasMany
    {
        return $this->hasMany(Voyage::class, 'ville_arrivee_id');
    }
}
