<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class StadiumBookingRequest extends FormRequest
{

    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string',
            'is_engineer'  => 'required|boolean',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time'   => 'required',
            'end_time'     => 'required',
            'purpose'      => 'nullable|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $start = strtotime($this->start_time);
            $end   = strtotime($this->end_time);

            if ($end <= $start) {
                $validator->errors()->add('start_time', 'وقت غير صحيح');
            }

            if ((($end - $start) % 3600) !== 0) {
                $validator->errors()->add('start_time', 'الحجز يجب أن يكون بالساعات فقط');
            }
        });
    }
}