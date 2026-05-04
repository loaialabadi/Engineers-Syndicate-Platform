<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\TripBooking; // أضفنا موديل الحجوزات
use Illuminate\Http\Request; // أضفنا كلاس الـ Request
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // أضفنا كلاس التوجيه

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

        // أبقينا واتساب كخيار احتياطي إذا أردت استخدامه في مكان آخر
        $phone   = config('app.whatsapp_phone', env('WHATSAPP_PHONE', '20XXXXXXXXXX'));
        $message = urlencode("أرغب في الاستفسار عن رحلة: {$trip->title}");
        $whatsappUrl = "https://wa.me/{$phone}?text={$message}";

        return view('public.trips.show', compact('trip', 'whatsappUrl'));
    }

    /**
     * معالجة طلب الحجز من النموذج
     */
    public function book(Request $request, Trip $trip): RedirectResponse
    {
        // 1. التحقق من البيانات
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'membership_number' => 'nullable|string|max:50',
 'national_id'       => [
            'required', 
            'digits:14', // التأكد أنه 14 رقم
            // شرط منع التكرار في نفس الرحلة
            \Illuminate\Validation\Rule::unique('trip_bookings')->where(function ($query) use ($trip) {
                return $query->where('trip_id', $trip->id);
            }),
        ],
            'seats'             => 'required|integer|min:1|max:' . ($trip->available_seats ?? 100),
        ]);

        // 2. إنشاء الحجز في قاعدة البيانات
        TripBooking::create([
            'trip_id'           => $trip->id,
            'name'              => $request->name,
            'phone'             => $request->phone,
            'membership_number' => $request->membership_number,
            'national_id'       => $request->national_id,
            'seats'             => $request->seats,
            'status'            => 'pending',
        ]);

        // 3. العودة برسالة نجاح
        return back()->with('success', 'تم استلام طلب حجزك بنجاح، وسنتواصل معك قريباً لتأكيد الحجز.');
    }
}
