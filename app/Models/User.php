<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail; // Add this import
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail // Implement MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'role',
        'mot_de_passe', // Correct password column name
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mot_de_passe' => 'hashed', // Correct password column name
    ];

    /**
     * Check if the user has an admin role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function getAuthPasswordName(): string
    {
        return 'mot_de_passe';
    }

    public function getAuthPassword(): string
    {
        return (string) $this->mot_de_passe;
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->mot_de_passe,
            set: fn ($value) => ['mot_de_passe' => $value],
        );
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
