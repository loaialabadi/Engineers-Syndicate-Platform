<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str; 
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TripRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(): View
    {
        $trips = Trip::withTrashed()->latest()->paginate(15);
        return view('admin.trips.index', compact('trips'));
    }

    public function create(): View
    {
        return view('admin.trips.create');
    }

public function store(TripRequest $request): RedirectResponse
{
    $data = $request->validated();

    // توليد slug فريد من العنوان + نص عشوائي لضمان عدم التكرار
    $data['slug'] = Str::slug($data['title'], '-', null) ?: Str::random(5);
    // إذا كان العنوان عربياً، السطر أعلاه قد يعطي نصاً فارغاً، لذا يفضل استخدامه هكذا:
    if (empty($data['slug'])) { $data['slug'] = time() . '-' . Str::random(3); }

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('trips', 'public');
    }

    Trip::create($data);

    return redirect()->route('admin.trips.index')
        ->with('success', 'تم إضافة الرحلة بنجاح.');
}


    public function edit(Trip $trip): View
    {
        return view('admin.trips.edit', compact('trip'));
    }

public function update(TripRequest $request, Trip $trip): RedirectResponse
{
    $data = $request->validated();

    // تحديث الـ slug بناءً على العنوان الجديد
    $data['slug'] = Str::slug($data['title'], '-', null) ?: $trip->slug;

    if ($request->hasFile('image')) {
        if ($trip->image) Storage::disk('public')->delete($trip->image);
        $data['image'] = $request->file('image')->store('trips', 'public');
    }

    $trip->update($data);

    return redirect()->route('admin.trips.index')
        ->with('success', 'تم تحديث الرحلة بنجاح.');
}


    public function destroy(Trip $trip): RedirectResponse
    {
        $trip->delete();
        return back()->with('success', 'تم حذف الرحلة.');
    }
}