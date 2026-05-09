<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voyage extends Model {
    protected $fillable = [
        'departure_city',
        'destination',
        'price',
        'departure_date',
        'transport_type',
        'transport_company_id',
        'available_seats',
        'departure_time',
        'line_name',
        'observations',
        'is_blocked',
        'blocked_by',
        'created_by_name'
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'is_blocked' => 'boolean',
    ];

    public function transportCompany(): BelongsTo {
        return $this->belongsTo(TransportCompany::class, 'transport_company_id');
    }
}