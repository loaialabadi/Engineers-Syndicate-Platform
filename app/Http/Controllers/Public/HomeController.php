<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Trip;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latestNews = News::published()
            ->latest()
            ->take(6)
            ->get();

        $upcomingTrips = Trip::active()
            ->upcoming()
            ->orderBy('trip_date')
            ->take(3)
            ->get();

        return view('public.home.index', compact('latestNews', 'upcomingTrips'));
    }
}