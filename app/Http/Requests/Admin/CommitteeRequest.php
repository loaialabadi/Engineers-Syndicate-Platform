<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

public function rules(): array
{
    return [
        'name'        => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'chairperson' => ['nullable', 'string', 'max:255'],
        'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        // تغيير boolean لـ nullable لأن checkbox قد لا يُرسل أصلاً
        'is_active'   => ['nullable'], 
        // إضافة nullable للترتيب إذا كان تركه فارغاً مسموحاً
        'sort_order'  => ['nullable', 'integer', 'min:0'],
    ];
}

}