<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'destination',
        'trip_date',
        'return_date',
        'price',
        'max_seats',
        'image',
        'is_active',
    ];

    protected $casts = [
        'trip_date' => 'date',
        'return_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(TripBooking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('trip_date', '>=', now());
    }
}