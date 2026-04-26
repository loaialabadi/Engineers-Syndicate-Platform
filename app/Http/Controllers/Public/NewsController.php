<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::published()
            ->latest()
            ->paginate(9);

        return view('public.news.index', compact('news'));
    }

    public function show(string $slug): View
    {
        $article = News::published()->where('slug', $slug)->firstOrFail();

        $related = News::published()
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.news.show', compact('article', 'related'));
    }
}