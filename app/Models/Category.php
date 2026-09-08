<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Services belonging to this category by category name.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'category', 'name');
    }

    /**
     * Get related bookings count dynamically.
     */
    public function getRelatedBookingsCount()
    {
        try {
            // Find service titles or slugs matching this category
            $serviceSlugs = Service::where('category', $this->name)->pluck('slug')->toArray();
            if (empty($serviceSlugs)) {
                // Fallback matching by category name in booking notes or service title
                return Booking::where('service_title', 'like', '%' . $this->name . '%')->count();
            }
            return Booking::whereIn('service_slug', $serviceSlugs)
                ->orWhere('service_title', 'like', '%' . $this->name . '%')
                ->count();
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
