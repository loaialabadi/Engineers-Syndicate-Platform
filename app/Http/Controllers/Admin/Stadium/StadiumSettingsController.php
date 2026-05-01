<?php
namespace App\Http\Controllers\Admin\Stadium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class StadiumSettingsController extends Controller
{
    public function index()
    {
        return view('admin.stadium.settings.index', [
            'price' => Setting::where('key', 'stadium_price')->value('value'),
            'whatsapp' => Setting::where('key', 'whatsapp_number')->value('value'),
            'notes' => Setting::where('key', 'stadium_notes')->value('value'),
            'open_time' => Setting::where('key', 'stadium_open_time')->value('value'),
            'close_time' => Setting::where('key', 'stadium_close_time')->value('value'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'whatsapp' => 'required',
            'notes' => 'nullable|string',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        Setting::updateOrCreate(
            ['key' => 'stadium_price'],
            ['value' => $request->price]
        );

        Setting::updateOrCreate(
            ['key' => 'whatsapp_number'],
            ['value' => $request->whatsapp]
        );

        Setting::updateOrCreate(
            ['key' => 'stadium_notes'],
            ['value' => $request->notes]
        );

        Setting::updateOrCreate(
            ['key' => 'stadium_open_time'],
            ['value' => $request->open_time]
        );

        Setting::updateOrCreate(
            ['key' => 'stadium_close_time'],
            ['value' => $request->close_time]
        );

        return back()->with('success', 'تم تحديث إعدادات الملعب بنجاح');
    }
}