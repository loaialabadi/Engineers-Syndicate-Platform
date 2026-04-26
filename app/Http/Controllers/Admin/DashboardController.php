<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\StadiumBooking;
use App\Models\Trip;
use App\Models\TripBooking;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_news'             => News::count(),
            'total_trips'            => Trip::count(),
            'total_stadium_bookings' => StadiumBooking::count(),
            'total_trip_bookings'    => TripBooking::count(),
            'pending_stadium'        => StadiumBooking::pending()->count(),
            'pending_trips'          => TripBooking::where('status', 'pending')->count(),
        ];

        $recentStadiumBookings = StadiumBooking::latest()->take(5)->get();
        $recentTripBookings    = TripBooking::with('trip')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentStadiumBookings', 'recentTripBookings'));
    }
}