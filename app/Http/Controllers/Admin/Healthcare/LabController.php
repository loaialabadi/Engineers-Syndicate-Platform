<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::latest()->paginate(10);
        return view('admin.healthcare.labs.index', compact('labs'));
    }

    public function create()
    {
        return view('admin.healthcare.labs.create');
    }   

    public function store(Request $request)
    {
        // التحقق من البيانات لمنع أخطاء قاعدة البيانات
        $request->validate([
            'name' => 'required',
            'discount_percent' => 'nullable|numeric|min:0|max:100'
        ]);

        Lab::create($request->all());
        
        // التوجيه لجدول المعامل بدلاً من الرجوع للخلف لضمان رؤية النتيجة
        return redirect()->route('admin.healthcare.labs.index')->with('success', 'تم إضافة المعمل بنجاح');
    }

    // إضافة دالة التعديل (ضرورية لفتح صفحة التعديل)
    public function edit(Lab $lab)
    {
        return view('admin.healthcare.labs.edit', compact('lab'));
    }

    public function update(Request $request, Lab $lab)
    {
        $lab->update($request->all());
        return redirect()->route('admin.healthcare.labs.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Lab $lab)
    {
        $lab->delete();
        return back()->with('success', 'تم الحذف بنget');
    }
}
