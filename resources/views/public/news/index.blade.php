@extends('layouts.public')
@section('title','الأخبار')
@section('content')
<div class="container py-5">
    <h2 class="section-title">الأخبار</h2>
    <div class="row g-4">
        @forelse($news as $article)
        <div class="col-md-4">
            <div class="card h-100">
                @if($article->image_url)
                    <img src="{{ $article->image_url }}" class="news-img" alt="{{ $article->title }}">
                @else
                    <div class="news-img d-flex align-items-center justify-content-center" style="background:#e9ecef">
                        <i class="bi bi-newspaper fs-1 text-muted"></i>
                    </div>
                @endif
                <div class="card-body">
                    <small class="text-muted"><i class="bi bi-calendar me-1"></i>{{ $article->published_at?->format('d M Y') }}</small>
                    <h6 class="fw-bold mt-2 mb-2">{{ $article->title }}</h6>
                    <p class="small text-muted">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}</p>
                </div>
                <div class="card-footer bg-transparent border-0 pb-3">
                    <a href="{{ route('news.show', $article->slug) }}" class="btn btn-sm btn-primary">اقرأ المزيد</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-newspaper fs-1 d-block mb-2"></i>لا توجد أخبار حالياً.
        </div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center">{{ $news->links() }}</div>
</div>
@endsection