<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripBooking extends Model
{
    protected $fillable = [
        'trip_id',
        'national_id',
        'name',
        'phone',
        'seats',
        'status',
        'admin_notes',
        'membership_number',
        'booking_reference'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    protected static function booted()
{
    static::creating(function ($booking) {
        $booking->booking_reference = 'TRIP-' . strtoupper(uniqid());
    });
}
}