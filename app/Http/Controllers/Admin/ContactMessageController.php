<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        // جلب الرسائل من الأحدث إلى الأقدم مع تقسيمها لصفحات
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return back()->with('success', 'تم حذف الرسالة بنجاح');
    }
}
