<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

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
            'discount_percent' => 'required|numeric|min:0|max:100'
        ]);

        Doctor::create($request->all());

        return redirect()->route('admin.healthcare.doctors.index')
            ->with('success', 'تم إضافة الطبيب');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.healthcare.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $doctor->update($request->all());

        return back()->with('success', 'تم التحديث');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return back()->with('success', 'تم الحذف');
    }
}