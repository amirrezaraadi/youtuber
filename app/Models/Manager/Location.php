<?php

namespace App\Models\Manager;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'building_number',
        'unit',
        "is_default",
        "mobile",
        "telephone",
        "postal_code",
        "address",
        'province_id',
        'city_id',
        'user_id',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function provinces():BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function cities():BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
