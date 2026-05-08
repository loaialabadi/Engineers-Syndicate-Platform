<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'content',
        'image',
        'has_whatsapp',
        'whatsapp_number',
        'whatsapp_message',
        'sort_order',
        'is_active',
    ];
}