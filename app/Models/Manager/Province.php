<?php

namespace App\Models\Manager;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends Model
{
    use HasFactory , Sluggable  ;

    protected $fillable = [
        'name',
        'slug',
        'country_id',
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function countries():BelongsTo
    {
        return $this->belongsTo(Country::class , 'country_id');
    }
}
