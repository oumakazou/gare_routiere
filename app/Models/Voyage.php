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
        'societe_id',
        'date_depart',
        'heure_depart',
        'heure_arrivee',
        'price',
        'base_price',
        'available_seats',
        'is_special',
    ];

    protected $casts = [
        'date_depart' => 'datetime',
        'heure_depart' => 'string', // Assuming time is stored as string 'HH:MM'
        'heure_arrivee' => 'string', // Assuming time is stored as string 'HH:MM'
        'price' => 'decimal:2',
        'base_price' => 'decimal:2',
        'is_special' => 'boolean',
    ];

    public function villeDepart(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_depart_id');
    }

    public function villeArrivee(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_arrivee_id');
    }

    public function societe(): BelongsTo
    {
        return $this->belongsTo(Societe::class, 'societe_id');
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

    public function transportCompany(): BelongsTo
    {
        return $this->belongsTo(TransportCompany::class);
    }

    public function getVilleDepartAttribute()
    {
        return (object) ['nom' => $this->attributes['ville_depart'] ?? 'Taza'];
    }

    public function getVilleArriveeAttribute()
    {
        return (object) ['nom' => $this->attributes['ville_arrivee'] ?? ''];
    }

    public function getSocieteAttribute()
    {
        return (object) ['nom' => $this->transportCompany?->name ?? ''];
    }

    public function getHeureDepartAttribute()
    {
        $time = $this->departure_time ?? $this->attributes['heure_depart'] ?? null;
        return $time ? \Carbon\Carbon::parse($time) : null;
    }

    public function getHeureArriveeAttribute()
    {
        $time = $this->attributes['heure_arrivee'] ?? null;
        return $time ? \Carbon\Carbon::parse($time) : null;
    }

    public function getDateDepartAttribute()
    {
        $date = $this->travel_date ?? $this->date_voyage ?? $this->attributes['date_depart'] ?? null;
        return $date ? \Carbon\Carbon::parse($date) : null;
    }

    public function getAvailableSeatsAttribute()
    {
        return $this->tickets ?? $this->places_disponibles ?? $this->attributes['available_seats'] ?? 0;
    }

    public function getPriceAttribute()
    {
        return $this->total_ttc ?? $this->prix ?? $this->attributes['price'] ?? 0;
    }

    public function getTypeVoyageAttribute()
    {
        return (object) ['nom' => 'National'];
    }

    public function getAutocarAttribute()
    {
        return (object) [
            'matricule' => 'A-1234',
            'capacite' => $this->available_seats,
            'societe' => (object) ['nom' => $this->transportCompany?->name ?? '']
        ];
    }
}
