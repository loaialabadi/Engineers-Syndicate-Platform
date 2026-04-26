@extends('layouts.public')
@section('title', $article->title)
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            @if($article->image_url)
                <img src="{{ $article->image_url }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height:420px;object-fit:cover" alt="{{ $article->title }}">
            @endif
            <h2 class="fw-black mb-2">{{ $article->title }}</h2>
            <p class="text-muted small mb-4">
                <i class="bi bi-calendar me-1"></i>{{ $article->published_at?->format('d F Y') }}
                @if($article->author)
                    &nbsp;|&nbsp;<i class="bi bi-person me-1"></i>{{ $article->author->name }}
                @endif
            </p>
            <div class="card p-4">
                {!! $article->content !!}
            </div>
            <a href="{{ route('news.index') }}" class="btn btn-outline-secondary mt-4">
                <i class="bi bi-arrow-right me-1"></i>العودة للأخبار
            </a>
        </div>
        @if($related->count())
        <div class="col-lg-4 mt-4 mt-lg-0">
            <h5 class="fw-bold mb-3">أخبار ذات صلة</h5>
            @foreach($related as $r)
            <div class="card mb-3 p-3">
                <h6 class="fw-bold mb-1 small">{{ $r->title }}</h6>
                <small class="text-muted">{{ $r->published_at?->format('d M Y') }}</small>
                <a href="{{ route('news.show', $r->slug) }}" class="stretched-link"></a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection