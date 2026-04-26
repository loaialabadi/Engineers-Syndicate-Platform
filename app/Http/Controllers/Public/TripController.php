<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(): View
    {
        $trips = Trip::active()
            ->upcoming()
            ->orderBy('trip_date')
            ->paginate(9);

        return view('public.trips.index', compact('trips'));
    }

    public function show(string $slug): View
    {
        $trip = Trip::active()->where('slug', $slug)->firstOrFail();

        $phone   = config('app.whatsapp_phone', env('WHATSAPP_PHONE', '20XXXXXXXXXX'));
        $message = urlencode(
            "مرحباً، أرغب في حجز رحلة:\n" .
            "الرحلة: {$trip->title}\n" .
            "التاريخ: {$trip->trip_date->format('Y-m-d')}\n" .
            "السعر: {$trip->price} جنيه\n" .
            "الاسم: "
        );

        $whatsappUrl = "https://wa.me/{$phone}?text={$message}";

        return view('public.trips.show', compact('trip', 'whatsappUrl'));
    }
}