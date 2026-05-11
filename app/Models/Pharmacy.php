<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'specialty',
        'phone',
        'whatsapp',
        'image',
        'address',
        'city',
        'location_url',
        'working_hours',
        'discount_percent',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'discount_percent' => 'float',
    ];

    // active scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // image URL
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default.png');
    }
}