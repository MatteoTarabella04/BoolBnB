<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price_per_night', 'rooms', 'beds', 'bathrooms', 'square_meters', 'address', 'longitude', 'latitude', 'image', 'visible', 'slug', 'user_id', 'apartment_type_id'];

    public static function generateSlug($name)
    {
        return Str::slug($name);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function apartment_type(): BelongsTo
    {
        return $this->belongsTo(ApartmentType::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function sponsorization_plans(): BelongsToMany
    {
        return $this->belongsToMany(SponsorizationPlan::class);
    }

}
