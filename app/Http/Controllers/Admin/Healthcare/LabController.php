<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LabController extends Controller
{
    public function index(Request $request)
    {
        $query = Lab::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('specialty', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%")
                  ->orWhere('city', 'like', "%$search%");
            });
        }

        $labs = $query->latest()->paginate(10);

        return view('admin.healthcare.labs.index', compact('labs'));
    }

    public function create()
    {
        return view('admin.healthcare.labs.create');
    }

public function store(Request $request)
{
    $data = $request->validate([
        'name'             => 'required|string|max:255',
        'description'      => 'nullable|string',
        'specialty'        => 'nullable|string|max:255',
        'phone'            => 'nullable|string|max:20',
        'whatsapp'         => 'nullable|string|max:20',
        'address'          => 'nullable|string|max:255',
        'city'             => 'nullable|string|max:255',
        'location_url'     => 'nullable|url',
        'working_hours'    => 'nullable|string|max:255',
        'discount_percent' => 'nullable|numeric|min:0|max:100',
        'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'is_active'        => 'nullable',
    ]);

    $data['slug'] = Str::slug($data['name']) ?: time() . '-' . Str::random(5);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('labs', 'public');
    }

    $data['is_active'] = $request->boolean('is_active');

    Lab::create($data);

    return redirect()
        ->route('admin.healthcare.labs.index')
        ->with('success', 'تم إضافة المعمل بنجاح');
}

    public function edit(Lab $lab)
    {
        return view('admin.healthcare.labs.edit', compact('lab'));
    }

    public function update(Request $request, Lab $lab)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'specialty'        => 'nullable|string|max:255',
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
            'name','description','specialty','phone','whatsapp',
            'address','city','location_url','working_hours','discount_percent'
        ]);

        $data['slug'] = Str::slug($request->name) ?: $lab->slug;

        if ($request->hasFile('image')) {
            if ($lab->image) {
                Storage::disk('public')->delete($lab->image);
            }

            $data['image'] = $request->file('image')->store('labs', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $lab->update($data);

        return redirect()
            ->route('admin.healthcare.labs.index')
            ->with('success', 'تم تحديث المعمل بنجاح');
    }

    public function destroy(Lab $lab)
    {
        if ($lab->image) {
            Storage::disk('public')->delete($lab->image);
        }

        $lab->delete();

        return back()->with('success', 'تم حذف المعمل بنجاح');
    }
}