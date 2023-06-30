<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price_per_night', 'rooms', 'beds', 'bathrooms', 'square_meters', 'address', 'longitude', 'latitude', 'image', 'visible', 'slug', 'user_id', 'apartment_type_id'];

    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}