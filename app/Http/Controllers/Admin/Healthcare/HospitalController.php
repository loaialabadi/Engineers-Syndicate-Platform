<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::latest()->paginate(10);
        return view('admin.healthcare.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.healthcare.hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',   
        ]);

        $data = $request->only([
            'name',
            'address',
            'phone',
            'discount_percent',
            'is_active'

        ]);
if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hospitals', 'public');
        }   
        // default value
        $data['is_active'] = $request->has('is_active') ? 1 : 1;

        Hospital::create($data);
        return redirect()
            ->route('admin.healthcare.hospitals.index')
            ->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.healthcare.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'name',
            'address',
            'phone',
            'discount_percent',
            'is_active'
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $hospital->update($data);

        return back()->with('success', 'تم التحديث');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return back()->with('success', 'تم الحذف');
    }
}