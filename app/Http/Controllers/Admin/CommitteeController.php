<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CommitteeController extends Controller
{
    public function index(): View
    {
        $committees = Committee::withTrashed()
            ->ordered()
            ->paginate(15);

        return view('admin.committees.index', compact('committees'));
    }

    public function create(): View
    {
        return view('admin.committees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'chairperson' => ['nullable', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_active'   => ['nullable'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        // رفع الصورة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('committees', 'public');
        }

        // checkbox
        $data['is_active'] = $request->has('is_active');

        Committee::create($data);

        return redirect()
            ->route('admin.committees.index')
            ->with('success', 'تم إضافة اللجنة بنجاح.');
    }

    public function edit(Committee $committee): View
    {
        return view('admin.committees.edit', compact('committee'));
    }

    public function update(Request $request, Committee $committee): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'chairperson' => ['nullable', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_active'   => ['nullable'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        // رفع صورة جديدة
        if ($request->hasFile('image')) {

            // حذف القديمة
            if ($committee->image) {
                Storage::disk('public')->delete($committee->image);
            }

            // تخزين الجديدة
            $data['image'] = $request->file('image')
                ->store('committees', 'public');
        }

        // checkbox
        $data['is_active'] = $request->has('is_active');

        $committee->update($data);

        return redirect()
            ->route('admin.committees.index')
            ->with('success', 'تم تحديث اللجنة بنجاح.');
    }

    public function destroy(Committee $committee): RedirectResponse
    {
        $committee->delete();

        return back()->with('success', 'تم حذف اللجنة.');
    }
}