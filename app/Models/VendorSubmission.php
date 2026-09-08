<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'category',
        'contact_person',
        'email',
        'phone',
        'location',
        'description',
        'price_range',
        'status',
    ];
}
