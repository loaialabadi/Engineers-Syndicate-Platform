<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommitteeRequest;
use App\Models\Committee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommitteeController extends Controller

{
    public function index(): View
    {
        $committees = Committee::withTrashed()->ordered()->paginate(15);
        return view('admin.committees.index', compact('committees'));
    }

    public function create(): View
    {


        return view('admin.committees.create');
    }

    public function store(CommitteeRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
            $request->merge([
                'image' => $request->file('image')->store('committees', 'public'),
            ]);
        }

        Committee::create($request->validated());
        return redirect()->route('admin.committees.index')
            ->with('success', 'تم إضافة اللجنة بنجاح.');
    }

    public function edit(Committee $committee): View
    {
        return view('admin.committees.edit', compact('committee'));
    }

public function update(CommitteeRequest $request, Committee $committee): RedirectResponse
{



    $data = $request->validated();
        // معالجة رفع الصورة عند التعديل
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة من السيرفر إذا وجدت
            if ($committee->image) {
                Storage::disk('public')->delete($committee->image);
            }
            // تخزين الصورة الجديدة
            $data['image'] = $request->file('image')->store('committees', 'public');
        }
    // هذا السطر يضمن أنه إذا لم يتم التأشير على المربع، سيتم تخزين false
    $data['is_active'] = $request->has('is_active');

    $committee->update($data);

    return redirect()->route('admin.committees.index')
        ->with('success', 'تم تحديث اللجنة بنجاح.');
}


    public function destroy(Committee $committee): RedirectResponse
    {
        $committee->delete();
        return back()->with('success', 'تم حذف اللجنة.');
    }
}