<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ["apartment_id", "visit_date", "ip_address"];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}

