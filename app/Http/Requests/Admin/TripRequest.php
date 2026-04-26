<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // يجب أن تكون true ليسمح لك بإرسال البيانات
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'destination'  => 'required|string|max:255',
            'description'  => 'required|string',
            'trip_date'    => 'required|date',
            'return_date'  => 'required|date|after_or_equal:trip_date',
            'price'        => 'required|numeric|min:0',
            'max_seats'    => 'required|integer|min:1',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active'    => 'boolean',
        ];
    }
}
