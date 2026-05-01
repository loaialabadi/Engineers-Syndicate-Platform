<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StadiumBooking extends Model
{


    protected $fillable = [
        'name',
        'phone',
        'is_engineer',
        'booking_date',
        'start_time',
        'end_time',
        'purpose',
        'status',
        'admin_notes',
        'booking_reference'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'is_engineer'  => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            $booking->booking_reference = 'ST-' . strtoupper(Str::random(6));
            $booking->status = 'pending';
        });
    }

    // منع التعارض
    public static function hasOverlap($date, $start, $end): bool
    {
        return self::where('booking_date', $date)
            ->where('status', '!=', 'rejected')
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

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'confirmed' => 'success',
            'rejected'  => 'danger',
            default     => 'warning',
        };
    }
    public function scopePending($query)
{
    return $query->where('status', 'pending');
}

public function scopeConfirmed($query)
{
    return $query->where('status', 'confirmed');
}

public function scopeRejected($query)
{
    return $query->where('status', 'rejected');
}
}