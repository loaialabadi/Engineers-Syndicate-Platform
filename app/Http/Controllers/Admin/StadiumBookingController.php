<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StadiumBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StadiumBookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = StadiumBooking::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15);

        return view('admin.bookings.stadium', compact('bookings'));
    }

    public function updateStatus(Request $request, StadiumBooking $booking): RedirectResponse
    {
        $request->validate([
            'status'      => ['required', 'in:pending,confirmed,rejected'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $booking->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'تم تحديث حالة الحجز بنجاح.');
    }
}