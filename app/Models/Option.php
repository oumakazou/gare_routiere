<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function autocars(): BelongsToMany
    {
        return $this->belongsToMany(Autocar::class, 'autocar_options')
            ->withTimestamps();
    }
}
