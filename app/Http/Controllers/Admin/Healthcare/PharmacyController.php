<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::latest()->paginate(10);

        return view('admin.healthcare.pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('admin.healthcare.pharmacies.create');
    }

        public function store(Request $request)
        {
            $request->validate([
                'name'             => 'required|string|max:255',
                'specialty'        => 'nullable|string|max:255',
                'phone'            => 'nullable|string|max:20',
                'address'          => 'nullable|string|max:255',
                'discount_percent' => 'nullable|numeric|min:0|max:100',
                'image'            => 'nullable|image|max:2048',
                'is_active'        => 'nullable',
            ]);

            $data = $request->only([
                'name',
                'specialty',
                'phone',
                'address',
                'discount_percent'
            ]);

            // is_active
            $data['is_active'] = $request->boolean('is_active');

            // image
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('pharmacies', 'public');
            }

            // slug
            $slug = Str::slug($request->name) ?: time().'-'.Str::random(5);

            $original = $slug;
            $i = 1;

            while (Pharmacy::where('slug', $slug)->exists()) {
                $slug = $original.'-'.$i++;
            }

            $data['slug'] = $slug;

            Pharmacy::create($data);

            return redirect()->route('admin.healthcare.pharmacies.index')
                ->with('success', 'تم إضافة الصيدلية بنجاح');
        }

    public function edit(Pharmacy $pharmacy)
    {
        return view('admin.healthcare.pharmacies.edit', compact('pharmacy'));
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'specialty'        => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:255',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'image'            => 'nullable|image|max:2048',
            'is_active'        => 'nullable',
            'city'             => 'nullable|string|max:255',
            'location_url'     => 'nullable|url',
            'working_hours'    => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'name',
            'specialty',
            'phone',
            'address',
            'discount_percent',
            'city',
            'location_url',
            'working_hours'
        ]);


        $data['is_active'] = $request->boolean('is_active');

         // slug
         $slug = Str::slug($request->name) ?: time().'-'.Str::random(5);

         $original = $slug;
         $i = 1;

         while (Pharmacy::where('slug', $slug)->where('id', '!=', $pharmacy->id)->exists()) {
             $slug = $original.'-'.$i++;
         }

         $data['slug'] = $slug; 

        // تحديث الصورة
        if ($request->hasFile('image')) {

            if ($pharmacy->image) {
                Storage::disk('public')->delete($pharmacy->image);
            }

            $data['image'] = $request->file('image')->store('pharmacies', 'public');
        }

        $pharmacy->update($data);

        return redirect()
            ->route('admin.healthcare.pharmacies.index')
            ->with('success', 'تم تحديث الصيدلية بنجاح');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        if ($pharmacy->image) {
            Storage::disk('public')->delete($pharmacy->image);
        }

        $pharmacy->delete();

        return back()->with('success', 'تم حذف الصيدلية بنجاح');
    }
}