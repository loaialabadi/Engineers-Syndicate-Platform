<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::query();

        // البحث
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('specialty', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");

            });
        }

        $doctors = $query->latest()->paginate(10);

        return view('admin.healthcare.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.healthcare.doctors.create');
    }

public function store(Request $request)
{
    $request->validate([

        'name'             => 'required|string|max:255',
        'specialty'        => 'nullable|string|max:255',
        'description'      => 'nullable|string',

        'phone'            => 'nullable|string|max:20',
        'whatsapp'         => 'nullable|string|max:20',

        'address'          => 'nullable|string|max:255',
        'city'             => 'nullable|string|max:255',

        'location_url'     => 'nullable|url',

        'working_hours'    => 'nullable|string|max:255',

        'discount_percent' => 'nullable|numeric|min:0|max:100',

        'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'is_active'        => 'nullable|boolean',

    ]);

    $data = $request->only([
        'name',
        'specialty',
        'description',
        'phone',
        'whatsapp',
        'address',
        'city',
        'location_url',
        'working_hours',
        'discount_percent',
    ]);

    // توليد slug
    $slug = Str::slug($request->name);

    // لو عربي
    if (empty($slug)) {
        $slug = time() . '-' . Str::random(5);
    }

    // منع التكرار
    $originalSlug = $slug;
    $count = 1;

    while (Doctor::where('slug', $slug)->exists()) {

        $slug = $originalSlug . '-' . $count;

        $count++;
    }

    $data['slug'] = $slug;

    // الصورة
    if ($request->hasFile('image')) {

        $data['image'] = $request->file('image')
            ->store('doctors', 'public');
    }

    // الحالة
    $data['is_active'] = $request->boolean('is_active');

    Doctor::create($data);

    return redirect()
        ->route('admin.healthcare.doctors.index')
        ->with('success', 'تم إضافة الطبيب بنجاح');
}
    public function edit(Doctor $doctor)
    {
        return view('admin.healthcare.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([

            'name'             => 'required|string|max:255',
            'specialty'        => 'nullable|string|max:255',
            'description'      => 'nullable|string',

            'phone'            => 'nullable|string|max:20',
            'whatsapp'         => 'nullable|string|max:20',

            'address'          => 'nullable|string|max:255',
            'city'             => 'nullable|string|max:255',

            'location_url'     => 'nullable|url',

            'working_hours'    => 'nullable|string|max:255',

            'discount_percent' => 'nullable|numeric|min:0|max:100',

            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'is_active'        => 'nullable|boolean',

        ]);

        $data = $request->only([
            'name',
            'specialty',
            'description',
            'phone',
            'whatsapp',
            'address',
            'city',
            'location_url',
            'working_hours',
            'discount_percent'
        ]);

        // تحديث slug
        $slug = Str::slug($request->name);

        if (empty($slug)) {
            $slug = $doctor->slug;
        }

        // منع التكرار
        $originalSlug = $slug;
        $count = 1;

        while (
            Doctor::where('slug', $slug)
                ->where('id', '!=', $doctor->id)
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;
        }

        $data['slug'] = $slug;

        // تحديث الصورة
        if ($request->hasFile('image')) {

            // حذف القديمة
            if ($doctor->image) {

                Storage::disk('public')
                    ->delete($doctor->image);
            }

            // رفع الجديدة
            $data['image'] = $request->file('image')
                ->store('doctors', 'public');
        }

        // الحالة
        $data['is_active'] = $request->boolean('is_active');

        $doctor->update($data);

        return redirect()
            ->route('admin.healthcare.doctors.index')
            ->with('success', 'تم تحديث بيانات الطبيب بنجاح');
    }

    public function destroy(Doctor $doctor)
    {
        // حذف الصورة
        if ($doctor->image) {

            Storage::disk('public')
                ->delete($doctor->image);
        }

        $doctor->delete();

        return back()->with('success', 'تم حذف الطبيب بنجاح');
    }
}