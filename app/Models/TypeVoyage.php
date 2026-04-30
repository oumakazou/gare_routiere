<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeVoyage extends Model
{
    use HasFactory;

    protected $table = 'type_voyages';

    protected $fillable = [
        'nom',
    ];

    public function voyages(): HasMany
    {
        return $this->hasMany(Voyage::class);
    }
}
