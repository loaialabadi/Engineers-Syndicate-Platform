<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);

        return view('admin.healthcare.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.healthcare.doctors.create');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'discount_percent' => 'required|numeric|min:0|max:100',
        'image' => 'nullable|image|max:2048',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'is_active' => 'nullable|boolean',
    ]);

    $data = $request->only([
        'name',
        'specialty',
        'phone',
        'address',
        'discount_percent',
        'is_active'
    ]);

    // لو مفيش is_active خليه default = 1
    $data['is_active'] = $request->has('is_active') ? 1 : 1;

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('doctors', 'public');
    }

    Doctor::create($data);

    return redirect()->route('admin.healthcare.doctors.index')
        ->with('success', 'تم إضافة الطبيب');
}
    public function edit(Doctor $doctor)
    {
        return view('admin.healthcare.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'name',
            'specialty',
            'address',
            'phone',
            'discount_percent'
        ]);

        // 👇 تحديث الصورة
        if ($request->hasFile('image')) {

            // حذف القديمة
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }

            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        $doctor->update($data);

        return back()->with('success', 'تم تحديث بيانات الطبيب');
    }

    public function destroy(Doctor $doctor)
    {
        // حذف الصورة من السيرفر
        if ($doctor->image) {
            Storage::disk('public')->delete($doctor->image);
        }

        $doctor->delete();

        return back()->with('success', 'تم حذف الطبيب');
    }
}