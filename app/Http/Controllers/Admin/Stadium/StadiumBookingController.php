<?php

namespace App\Http\Controllers\Admin\Stadium;

use App\Http\Controllers\Controller;
use App\Models\StadiumBooking;
use Illuminate\Http\Request;

class StadiumBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = StadiumBooking::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15);

        return view('admin.stadium.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, StadiumBooking $booking)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,rejected'],
            'admin_notes' => ['nullable', 'string']
        ]);

        $booking->update($request->only('status', 'admin_notes'));

        return back()->with('success', 'تم التحديث بنجاح');
    }
}