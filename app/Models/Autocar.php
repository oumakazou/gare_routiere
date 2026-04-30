<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autocar extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'capacite',
        'type',
        'societe_id',
    ];

    public function societe(): BelongsTo
    {
        return $this->belongsTo(Societe::class);
    }

    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'autocar_equipements')
            ->withTimestamps();
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'autocar_options')
            ->withTimestamps();
    }

    public function voyages(): HasMany
    {
        return $this->hasMany(Voyage::class);
    }
}
