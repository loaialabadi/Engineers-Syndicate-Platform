<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'nullable',
            'description' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'has_whatsapp' => 'boolean',
            'whatsapp_number' => 'nullable',
            'whatsapp_message' => 'nullable',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // رفع الصورة وإنشاء المجلدات داخل public تلقائياً
            $file->move(public_path('images/services'), $filename);
            
            $data['image'] = 'images/services/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'nullable',
            'description' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'has_whatsapp' => 'boolean',
            'whatsapp_number' => 'nullable',
            'whatsapp_message' => 'nullable',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة من المجلد إذا وجدت
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $file->move(public_path('images/services'), $filename);
            $data['image'] = 'images/services/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة');
    }

    public function destroy(Service $service)
    {
        // حذف ملف الصورة من المجلد عند حذف الخدمة
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return back()->with('success', 'تم حذف الخدمة وصورتها بنجاح');
    }
}
