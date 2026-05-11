<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HospitalController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::query();

        // البحث
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('specialty', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");

            });
        }

        $hospitals = $query->latest()->paginate(10);

        return view('admin.healthcare.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.healthcare.hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name'             => 'required|string|max:255',
            'specialty'        => 'nullable|string|max:255',
            'description'      => 'nullable|string',

            'phone'            => 'nullable|string|max:20',
            'whatsapp'         => 'nullable|string|max:20',

            'address'          => 'nullable|string|max:255',
            'city'             => 'nullable|string|max:255',

            'location_url'     => 'nullable|string',

            'working_hours'    => 'nullable|string|max:255',

            'discount_percent' => 'nullable|numeric|min:0|max:100',

            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'is_active'        => 'nullable|boolean',

        ]);
        $data = $request->only([
            'name',
            'specialty',
            'description',
            'phone',
            'whatsapp',
            'address',
            'city',
            'location_url',
            'working_hours',
            'discount_percent'
        ]);

        $data['discount_percent'] = $request->filled('discount_percent')
            ? $request->discount_percent
            : 0;
        // slug
        $slug = Str::slug($request->name);

        if (empty($slug)) {
            $slug = time() . '-' . Str::random(5);
        }

        // منع التكرار
        $originalSlug = $slug;
        $count = 1;

        while (Hospital::where('slug', $slug)->exists()) {

            $slug = $originalSlug . '-' . $count;

            $count++;
        }

        $data['slug'] = $slug;

        // الصورة
        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')
                ->store('hospitals', 'public');
        }

        // الحالة
        $data['is_active'] = $request->boolean('is_active');

        
        Hospital::create($data);

        return redirect()
            ->route('admin.healthcare.hospitals.index')
            ->with('success', 'تم إضافة المستشفى بنجاح');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.healthcare.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([

            'name'             => 'required|string|max:255',
            'specialty'        => 'nullable|string|max:255',
            'description'      => 'nullable|string',

            'phone'            => 'nullable|string|max:20',
            'whatsapp'         => 'nullable|string|max:20',

            'address'          => 'nullable|string|max:255',
            'city'             => 'nullable|string|max:255',

            'location_url'     => 'nullable|url',

            'working_hours'    => 'nullable|string|max:255',

            'discount_percent' => 'nullable|numeric|min:0|max:100',

            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'is_active'        => 'nullable|boolean',

        ]);

        $data = $request->only([
            'name',
            'specialty',
            'description',
            'phone',
            'whatsapp',
            'address',
            'city',
            'location_url',
            'working_hours',
            'discount_percent'
        ]);

        // تحديث slug
        $slug = Str::slug($request->name);

        if (empty($slug)) {
            $slug = $hospital->slug;
        }

        $originalSlug = $slug;
        $count = 1;

        while (
            Hospital::where('slug', $slug)
                ->where('id', '!=', $hospital->id)
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;
        }

        $data['slug'] = $slug;

        // تحديث الصورة
        if ($request->hasFile('image')) {

            // حذف القديمة
            if ($hospital->image) {

                Storage::disk('public')
                    ->delete($hospital->image);
            }

            // رفع الجديدة
            $data['image'] = $request->file('image')
                ->store('hospitals', 'public');
        }

        // الحالة
        $data['is_active'] = $request->boolean('is_active');

        $hospital->update($data);

        return redirect()
            ->route('admin.healthcare.hospitals.index')
            ->with('success', 'تم تحديث المستشفى بنجاح');
    }

    public function destroy(Hospital $hospital)
    {
        // حذف الصورة
        if ($hospital->image) {

            Storage::disk('public')
                ->delete($hospital->image);
        }

        $hospital->delete();

        return back()->with('success', 'تم حذف المستشفى بنجاح');
    }
}