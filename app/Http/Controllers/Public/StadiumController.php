<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StadiumBooking;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StadiumController extends Controller
{
    private function generateSlots($date)
    {
        $settings = Setting::pluck('value','key');

        $openTime  = $settings['stadium_open_time'] ?? '09:00';
        $closeTime = $settings['stadium_close_time'] ?? '02:00';
        $duration  = (int) ($settings['slot_duration'] ?? 30); // 🔥 30 min default

        $bookings = StadiumBooking::whereDate('booking_date', $date)
            ->where('status', '!=', 'rejected')
            ->get();

        $start = Carbon::createFromFormat('H:i', $openTime);
        $end   = Carbon::createFromFormat('H:i', $closeTime);

        if ($end <= $start) {
            $end->addDay();
        }

        $slots = [];

        while ($start < $end) {

            $slotStart = $start->format('H:i');

            $next = (clone $start)->addMinutes($duration);
            $slotEnd = $next->format('H:i');

            $isBooked = $bookings->contains(function ($b) use ($slotStart, $slotEnd) {
                return !($b->end_time <= $slotStart || $b->start_time >= $slotEnd);
            });

            $slots[] = [
                'start'  => $slotStart,
                'end'    => $slotEnd,
                'booked' => $isBooked
            ];

            $start = $next;
        }

        return $slots;
    }

    public function index(Request $request)
    {
        $date = $request->get('date');

        $slots = [];
        $dayName = null;

        $settings = Setting::pluck('value','key');

        if ($date) {
            $dayName = Carbon::parse($date)->translatedFormat('l');
            $slots = $this->generateSlots($date);
        }

        return view('public.stadium.index', compact(
            'slots',
            'date',
            'dayName',
            'settings'
        ));
    }

    public function slots(Request $request)
    {
        return response()->json(
            $this->generateSlots($request->date)
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'slots' => 'required|array',
            'name'  => 'required',
            'phone' => 'required',
            'booking_date' => 'required|date',
        ]);

        $slots = $request->slots;

        if (count($slots) == 0) {
            return back()->withErrors(['slots' => 'اختار وقت']);
        }

        // حساب البداية والنهاية
        $start = null;
        $end = null;

        foreach ($slots as $slot) {
            [$s, $e] = explode('-', $slot);

            if (!$start || $s < $start) $start = $s;
            if (!$end || $e > $end) $end = $e;
        }

        if (StadiumBooking::hasOverlap($request->booking_date, $start, $end)) {
            return back()->withErrors(['slots' => 'هذا الوقت محجوز']);
        }

        $booking = StadiumBooking::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'is_engineer' => $request->is_engineer ?? 0,
            'booking_date' => $request->booking_date,
            'start_time' => $start,
            'end_time' => $end,
            'status' => 'pending',
        ]);

$whatsapp = Setting::where('key','whatsapp_number')->value('value');

        $message = urlencode(
            "حجز جديد\n" .
            "رقم: {$booking->booking_reference}\n" .
            "من: {$booking->start_time} إلى {$booking->end_time}"
        );

return view('public.stadium.confirm', [
    'booking' => $booking,
    'whatsapp' => $whatsapp
]);    }
}