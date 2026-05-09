<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\News;
use App\Models\Service;
use App\Models\StadiumBooking;
use App\Models\Trip;
use App\Models\TripBooking;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Lab;
use App\Models\Pharmacy;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [

            // الأخبار
            'total_news' => News::count(),

            // الرحلات
            'total_trips' => Trip::count(),

            // حجوزات الملعب
            'total_stadium_bookings' => StadiumBooking::count(),

            // حجوزات الرحلات
            'total_trip_bookings' => TripBooking::count(),

            // الحجوزات المعلقة
            'pending_stadium' => StadiumBooking::pending()->count(),

            'pending_trips' => TripBooking::where('status', 'pending')->count(),

            // اللجان
            'total_committees' => Committee::count(),

            // خدمات النقابة
            'total_services' => Service::count(),

            // الرعاية الصحية والتعاقدات
            'total_healthcare' =>
                Doctor::count()
                + Hospital::count()
                + Pharmacy::count()
                + Lab::count(),

            // الرسائل
            // عدلها لاحقاً لو عملت جدول رسائل
            'total_messages' => 0,

        ];

        // آخر حجوزات الملعب
        $recentStadiumBookings = StadiumBooking::latest()
            ->take(5)
            ->get();

        // آخر حجوزات الرحلات
        $recentTripBookings = TripBooking::with('trip')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentStadiumBookings',
            'recentTripBookings'
        ));
    }
}