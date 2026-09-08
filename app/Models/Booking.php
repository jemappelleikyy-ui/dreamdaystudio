<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'service_slug',
        'service_title',
        'service_image',
        'customer_name',
        'customer_email',
        'customer_phone',
        'event_date',
        'event_time',
        'event_location',
        'guest_count',
        'notes',
        'addons',
        'subtotal',
        'tax',
        'total_price',
        'dp_percentage',
        'dp_amount',
        'amount_paid',
        'remaining_amount',
        'payment_method',
        'payment_proof',
        'status',
        'payment_status',
        'confirmed_at',
        'expires_at',
    ];

    protected $casts = [
        'addons' => 'array',
        'event_date' => 'string',
        'confirmed_at' => 'datetime',
        'expires_at' => 'datetime',
        'subtotal' => 'integer',
        'tax' => 'integer',
        'total_price' => 'integer',
        'dp_percentage' => 'integer',
        'dp_amount' => 'integer',
        'amount_paid' => 'integer',
        'remaining_amount' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id', 'id')->orderBy('created_at', 'desc');
    }
}
