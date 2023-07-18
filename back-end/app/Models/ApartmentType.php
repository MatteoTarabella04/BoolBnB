<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApartmentType extends Model
{
    use HasFactory;

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }
}
