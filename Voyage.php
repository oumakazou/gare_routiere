<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voyage extends Model {
    protected $fillable = [
        'ville_depart_id',
        'ville_arrivee_id',
        'societe_id',
        'autocar_id',
        'type_voyage_id',
        'price',
        'base_price',
        'date_depart',
        'heure_depart',
        'heure_arrivee',
        'available_seats',
        'line_name',
        'observations',
        'is_blocked',
        'blocked_by',
        'created_by_name',
        'is_special'
    ];

    protected $casts = [
        'date_depart' => 'datetime',
        'is_blocked' => 'boolean',
    ];

    public function villeDepart(): BelongsTo {
        return $this->belongsTo(Ville::class, 'ville_depart_id');
    }

    public function villeArrivee(): BelongsTo {
        return $this->belongsTo(Ville::class, 'ville_arrivee_id');
    }

    public function societe(): BelongsTo {
        return $this->belongsTo(Societe::class, 'societe_id');
    }

    public function reservations(): HasMany {
        return $this->hasMany(Reservation::class);
    }

    public function transportCompany(): BelongsTo {
        // Assuming societe_id is also used for TransportCompany,
        // as there is no other foreign key for TransportCompany in the voyages table.
        return $this->belongsTo(TransportCompany::class, 'societe_id');
    }
}