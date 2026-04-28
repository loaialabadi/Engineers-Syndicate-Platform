<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'specialty',
        'phone',
        'address',
        'discount_percent',
        'is_active',
        'image',
        
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'discount_percent' => 'float',
    ];

    // 🔹 Scope: active doctors
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

        // 🔹 Accessor: full image UR
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('images/default.png');
    }

}