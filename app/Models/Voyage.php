<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ville_depart_id',
        'ville_arrivee_id',
        'autocar_id',
        'type_voyage_id',
        'date_depart',
        'heure_depart',
        'heure_arrivee',
        'base_price',
        'is_special',
    ];

    protected $casts = [
        'date_depart' => 'date',
        'heure_depart' => 'datetime:H:i',
        'heure_arrivee' => 'datetime:H:i',
        'base_price' => 'decimal:2',
        'is_special' => 'boolean',
    ];

    public function getPriceAttribute(): float
    {
        return $this->is_special ? round($this->base_price * 1.3, 2) : $this->base_price;
    }

    public function getSpecialLabelAttribute(): ?string
    {
        return $this->is_special ? 'Offre spéciale' : null;
    }

    public function villeDepart(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_depart_id');
    }

    public function villeArrivee(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_arrivee_id');
    }

    public function autocar(): BelongsTo
    {
        return $this->belongsTo(Autocar::class);
    }

    public function typeVoyage(): BelongsTo
    {
        return $this->belongsTo(TypeVoyage::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
