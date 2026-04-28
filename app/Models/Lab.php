<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'working_hours',
        'discount_percent',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'discount_percent' => 'float',
    ];

    // 🔹 Scope: active labs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

        // 🔹 Accessor: full image URL
        public function getImageUrlAttribute()
        {
            if ($this->image) {
                return asset('storage/' . $this->image);
            }
    
            return asset('images/default.png');
        }
}