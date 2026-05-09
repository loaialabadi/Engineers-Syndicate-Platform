<?php

namespace App\Http\Controllers\Admin\Trip;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(): View
    {
        $trips = Trip::withTrashed()
            ->latest()
            ->paginate(15);

        return view('admin.trips.index', compact('trips'));
    }

    public function create(): View
    {
        return view('admin.trips.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'destination'  => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'trip_date'    => ['required', 'date'],
            'return_date'  => ['required', 'date', 'after_or_equal:trip_date'],
            'price'        => ['required', 'numeric', 'min:0'],
            'max_seats'    => ['required', 'integer', 'min:1'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_active'    => ['nullable'],
        ]);

        // توليد slug
        $data['slug'] = Str::slug($data['title']);

        if (empty($data['slug'])) {
            $data['slug'] = time() . '-' . Str::random(5);
        }

        // رفع الصورة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('trips', 'public');
        }

        // checkbox
        $data['is_active'] = $request->has('is_active');

        Trip::create($data);

        return redirect()
            ->route('admin.trips.index')
            ->with('success', 'تم إضافة الرحلة بنجاح.');
    }

    public function edit(Trip $trip): View
    {
        return view('admin.trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip): RedirectResponse
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'destination'  => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'trip_date'    => ['required', 'date'],
            'return_date'  => ['required', 'date', 'after_or_equal:trip_date'],
            'price'        => ['required', 'numeric', 'min:0'],
            'max_seats'    => ['required', 'integer', 'min:1'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_active'    => ['nullable'],
        ]);

        // تحديث slug
        $data['slug'] = Str::slug($data['title']);

        if (empty($data['slug'])) {
            $data['slug'] = $trip->slug;
        }

        // رفع صورة جديدة
        if ($request->hasFile('image')) {

            // حذف القديمة
            if ($trip->image) {
                Storage::disk('public')->delete($trip->image);
            }

            // تخزين الجديدة
            $data['image'] = $request->file('image')
                ->store('trips', 'public');
        }

        // checkbox
        $data['is_active'] = $request->has('is_active');

        $trip->update($data);

        return redirect()
            ->route('admin.trips.index')
            ->with('success', 'تم تحديث الرحلة بنجاح.');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        $trip->delete();

        return back()->with('success', 'تم حذف الرحلة.');
    }
}