<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransportCompany extends Model {
    protected $fillable = ['name', 'logo'];
    public function voyages(): HasMany {
        return $this->hasMany(Voyage::class);
    }
}