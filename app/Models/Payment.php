<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'payment_type',
        'amount',
        'payment_method',
        'payment_proof',
        'status',
        'notes',
        'paid_at',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'integer',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
