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

    // *** هذه هي الدالة التي يجب إضافتها ***
    public function create()
    {
        return view('admin.healthcare.hospitals.create');
    }

    public function store(Request $request)
    {
        // يفضل إضافة التحقق هنا لضمان جودة البيانات
        $request->validate([
            'name' => 'required',
            'discount_percent' => 'nullable|numeric'
        ]);

        Hospital::create($request->all());
        return redirect()->route('admin.healthcare.hospitals.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.healthcare.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $hospital->update($request->all());
        return back()->with('success', 'تم التحديث');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return back()->with('success', 'تم الحذف');
    }
}
