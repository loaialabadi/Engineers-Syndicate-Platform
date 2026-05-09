<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
protected $fillable = [
    'name',
    'slug',
    'specialty',
    'description',
    'phone',
    'whatsapp',
    'image',
    'address',
    'location_url',
    'city',
    'working_hours',
    'discount_percent',
    'is_active',
];

    protected $casts = [
        'is_active' => 'boolean',
        'discount_percent' => 'float',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default.png');
    }
}