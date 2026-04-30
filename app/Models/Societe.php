<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Societe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'contact',
    ];

    public function autocars(): HasMany
    {
        return $this->hasMany(Autocar::class);
    }
}
