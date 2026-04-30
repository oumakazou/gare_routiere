<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voyage_id',
        'nombre_places',
        'seat_numbers',
        'mode_reglement_id',
        'date_reservation',
        'status',
        'total_price',
    ];

    protected $casts = [
        'seat_numbers' => 'array',
        'date_reservation' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function voyage(): BelongsTo
    {
        return $this->belongsTo(Voyage::class);
    }

    public function modeReglement(): BelongsTo
    {
        return $this->belongsTo(ModeReglement::class);
    }
}
