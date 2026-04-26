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
        $committee->update($request->validated());
        return redirect()->route('admin.committees.index')
            ->with('success', 'تم تحديث اللجنة بنجاح.');
    }

    public function destroy(Committee $committee): RedirectResponse
    {
        $committee->delete();
        return back()->with('success', 'تم حذف اللجنة.');
    }
}