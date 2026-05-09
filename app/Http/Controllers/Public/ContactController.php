<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // تأكد من إنشاء الموديل أولاً
use App\Http\Controllers\Controller;
class ContactController extends Controller
{
    // عرض الصفحة للمستخدم
    public function index()
    {
          $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('public.contact.index',compact('settings')); 
    }

    // استقبال البيانات وحفظها
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email',
            'type'    => 'required|in:استفسار,شكوى,طلب',
            'subject' => 'required|string|max:255',
            'message' => 'required',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/contacts'), $filename);
            $data['attachment'] = 'uploads/contacts/' . $filename;
        }

        ContactMessage::create($data);

        return back()->with('success', 'تم إرسال رسالتك بنجاح، سنقوم بالرد عليك في أقرب وقت.');
    }
}
