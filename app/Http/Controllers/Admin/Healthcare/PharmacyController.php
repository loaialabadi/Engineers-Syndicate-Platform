<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy; // استدعاء الموديل
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::latest()->paginate(10);
        return view('admin.healthcare.pharmacies.index', compact('pharmacies'));
    }

    // عرض صفحة الإضافة
    public function create()
    {
        return view('admin.healthcare.pharmacies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'image' => 'nullable|image|max:2048',
                'is_active' => 'nullable|boolean',
            'discount_percent' => 'required|numeric'
,
            
        ]);
        
         $data = $request->only([
            'name',
            
            'address',
            'phone',
            'is_active',
            'discount_percent'
        ]);
        // لو مفيش is_active خليه default = 1
        $data['is_active'] = $request->has('is_active') ? 1 : 1;    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pharmacies', 'public');
        }

        $data = $request->only([
            'name',
            'specialty',
            'phone',
            'address',
            'discount_percent',
            'is_active'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pharmacies', 'public');
        }
        Pharmacy::create($data);
        return redirect()->route('admin.healthcare.pharmacies.index')->with('success', 'تم إضافة الصيدلية بنجاح');} 


    public function edit(Pharmacy $pharmacy)
    {
        return view('admin.healthcare.pharmacies.edit', compact('pharmacy'));
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());
        return redirect()->route('admin.healthcare.pharmacies.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
