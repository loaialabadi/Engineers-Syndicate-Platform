<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    // الحقول المسموح بتخزينها في قاعدة البيانات
    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'subject',
        'message',
        'attachment',
    ];
}
