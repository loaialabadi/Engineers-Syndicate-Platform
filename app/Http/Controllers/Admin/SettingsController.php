<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([

            // عام
            'site_name' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'youtube_url' => 'nullable|string',

            // الملعب
            'stadium_price' => 'nullable|numeric',
            'stadium_open_time' => 'nullable',
            'stadium_close_time' => 'nullable',
            'stadium_notes' => 'nullable|string',

            // الرحلات
            'trips_whatsapp' => 'nullable|string',
            'trips_notes' => 'nullable|string',

        ]);

        foreach ($request->except('_token') as $key => $value) {

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );

        }

        return back()->with('success', 'تم تحديث الإعدادات بنجاح');
    }
}