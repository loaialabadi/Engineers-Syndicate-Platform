<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // تم التغيير هنا
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::withTrashed()->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse // تم تغيير النوع هنا
    {
        // التحقق من البيانات يدوياً داخل الدالة
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'is_published' => 'nullable', 
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $data['slug'] = Str::slug($request->title); 
        $data['created_by'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($request->has('is_published')) {
            $data['published_at'] = now();
            $data['is_published'] = true;
        } else {
            $data['is_published'] = false;
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'تم إضافة الخبر بنجاح.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse // تم تغيير النوع هنا
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'is_published' => 'nullable',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($request->has('is_published')) {
            if (!$news->published_at) {
                $data['published_at'] = now();
            }
            $data['is_published'] = true;
        } else {
            $data['is_published'] = false;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'تم تحديث الخبر بنجاح.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();
        return back()->with('success', 'تم حذف الخبر.');
    }

    public function togglePublish(News $news): RedirectResponse
    {
        $news->update([
            'is_published' => !$news->is_published,
            'published_at' => !$news->is_published ? now() : $news->published_at,
        ]);

        $msg = $news->is_published ? 'تم نشر الخبر.' : 'تم إلغاء نشر الخبر.';
        return back()->with('success', $msg);
    }
}
