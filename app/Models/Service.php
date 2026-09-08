<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'category',
        'price',
        'price_formatted',
        'image',
        'location',
        'rating',
        'capacity',
        'badge',
        'description',
        'highlights',
        'addons',
    ];

    protected $casts = [
        'price' => 'integer',
        'highlights' => 'array',
        'addons' => 'array',
    ];

    public function availabilities()
    {
        return $this->hasMany(ServiceAvailability::class);
    }
}
