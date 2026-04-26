<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StadiumBooking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'booking_date',
        'start_time',
        'end_time',
        'purpose',
        'booking_reference',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            $booking->booking_reference = 'ST-' . strtoupper(uniqid());
        });
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public static function hasOverlap($date, $start, $end)
    {
        return self::where('booking_date', $date)
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_time', [$start, $end])
                  ->orWhereBetween('end_time', [$start, $end])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->where('start_time', '<=', $start)
                         ->where('end_time', '>=', $end);
                  });
            })
            ->exists();
    }
}