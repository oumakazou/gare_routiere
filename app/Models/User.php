<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'role',
        'is_admin',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'mot_de_passe' => 'hashed',
    ];

    public function getAuthPasswordName(): string
    {
        return 'mot_de_passe';
    }

    public function getAuthPassword(): string
    {
        return (string) $this->mot_de_passe;
    }

    public function getNameAttribute(): string
    {
        return (string) $this->nom;
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
