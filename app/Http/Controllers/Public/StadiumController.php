<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StadiumBookingRequest;
use App\Models\StadiumBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StadiumController extends Controller
{
    public function index(): View
    {
        return view('public.stadium.index');
    }

    public function store(StadiumBookingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (StadiumBooking::hasOverlap($data['booking_date'], $data['start_time'], $data['end_time'])) {
            return back()
                ->withInput()
                ->withErrors(['start_time' => 'هذا الوقت محجوز بالفعل. يرجى اختيار وقت آخر.']);
        }

        $booking = StadiumBooking::create($data);

        $phone   = env('WHATSAPP_PHONE', '20XXXXXXXXXX');
        $message = urlencode(
            "طلب حجز ملعب جديد:\n" .
            "الاسم: {$booking->name}\n" .
            "التاريخ: {$booking->booking_date->format('Y-m-d')}\n" .
            "من: {$booking->start_time} إلى: {$booking->end_time}\n" .
            "الغرض: {$booking->purpose}\n" .
            "رقم الحجز: {$booking->booking_reference}"
        );

        return redirect("https://wa.me/{$phone}?text={$message}");
    }
}