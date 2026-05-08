<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\TripBooking; // أضفنا موديل الحجوزات
use Illuminate\Http\Request; // أضفنا كلاس الـ Request
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // أضفنا كلاس التوجيه
use App\Models\Setting;

class TripController extends Controller
{
    public function index(): View
    {

        $trips = Trip::active()
            ->upcoming()
            ->orderBy('trip_date')
            ->paginate(9);

        return view('public.trips.index', compact('trips',
     // أرسلنا الإعدادات للعرض في الصفحة
            ));
    }

    public function show(string $slug): View
    {
        $trip = Trip::active()->where('slug', $slug)->firstOrFail();
        $settings = Setting::pluck('value', 'key');

        // أبقينا واتساب كخيار احتياطي إذا أردت استخدامه في مكان آخر
        $phone   = config('app.whatsapp_phone', env('WHATSAPP_PHONE', '20XXXXXXXXXX'));
        $message = urlencode("أرغب في الاستفسار عن رحلة: {$trip->title}");
        $whatsappUrl = "https://wa.me/{$phone}?text={$message}";

        return view('public.trips.show', compact('trip', 'whatsappUrl', 'settings'));
    }

    /**
     * معالجة طلب الحجز من النموذج
     */

public function book(Request $request, Trip $trip): RedirectResponse
{
    $request->validate([
        'name'              => 'required|string|max:255',
        'phone'             => 'required|string|max:20',
        'membership_number' => 'nullable|string|max:50',
        'national_id'       => 'nullable|string|max:20',
        //  [
        //     'required',
        //     'digits:14',
        //     \Illuminate\Validation\Rule::unique('trip_bookings')->where(function ($query) use ($trip) {
        //         return $query->where('trip_id', $trip->id);
        //     }),
        // ],
        'seats' => 'required|integer|min:1|max:' . ($trip->available_seats ?? 100),
    ]);

    // ✅ 1. حفظ الحجز في قاعدة البيانات أولاً
    $booking = TripBooking::create([
        'trip_id'           => $trip->id,
        'name'              => $request->name,
        'phone'             => $request->phone,
        'membership_number' => $request->membership_number,
        'national_id'       => $request->national_id,
        'seats'             => $request->seats,
        'status'            => 'pending',
        'booking_reference' => 'TRIP-' . strtoupper(uniqid()), // تأكد من وجود العمود في الـ Migration
    ]);

    // ✅ 2. رابط جروب الواتساب الخاص بك
    $whatsappGroupLink = "https://chat.whatsapp.com/HkYzknZrWtN1to5dPQmAX3";

    // ✅ 3. التوجيه المباشر للجروب
    // ملحوظة: روابط الجروبات لا تدعم إرسال رسالة تلقائية (text) مثل أرقام الأفراد
return redirect()->route('trips.confirmation', $booking->id);
}

public function confirmation(TripBooking $booking)
{
    $trip = $booking->trip;

    // رقم الواتساب من settings
    $whatsapp = Setting::where('key', 'trips_whatsapp_number')
        ->value('value');

    // لينك الجروب أو رسالة مباشرة
    $message = urlencode(
        "تأكيد حجز رحلة\n" .
        "رقم الحجز: {$booking->booking_reference}\n" .
        "الاسم: {$booking->name}\n" .
        "الرحلة: {$trip->title}"
    );

    $whatsappGroupLink = "https://wa.me/{$whatsapp}?text={$message}";

    return view('public.trips.confirmation', compact(
        'booking',
        'trip',
        'whatsappGroupLink'
    ));
}


}
