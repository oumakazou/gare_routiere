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
        'transport_company_id',
        'line_name',
        'destination',
        'travel_date',
        'departure_time',
        'tickets',
        'total_ttc',
        'observations',
        'is_blocked',
        'blocked_by',
        'created_by_name',
        'ville_depart',
        'ville_arrivee',
        'date_voyage',
        'prix',
        'places_disponibles',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'departure_time' => 'string',
        'tickets' => 'integer',
        'total_ttc' => 'decimal:2',
        'is_blocked' => 'boolean',
        'date_voyage' => 'date',
        'prix' => 'decimal:2',
        'places_disponibles' => 'integer',
    ];

    public function transportCompany(): BelongsTo
    {
        return $this->belongsTo(TransportCompany::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
