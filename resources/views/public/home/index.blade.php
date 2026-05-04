@extends('layouts.public')
@section('title', 'الرئيسية')

@section('content')
{{-- Hero --}}
<section class="hero-section">
    <div class="container text-center">
        <h1 class="fw-black display-5 mb-3">المنصة الرقمية لنقابة المهندسين</h1>
        <p class="lead mb-4 opacity-75">خدمات متكاملة لأعضاء النقابة — أخبار، رحلات، لجان، وحجوزات</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('trips.index') }}" class="btn btn-warning btn-lg fw-bold px-4">
                <i class="bi bi-geo-alt me-2"></i>استعرض الرحلات
            </a>
            <a href="{{ route('stadium.index') }}" class="btn btn-outline-light btn-lg fw-bold px-4">
                <i class="bi bi-trophy me-2"></i>احجز الملعب
            </a>
        </div>
    </div>
</section>

{{-- Quick Links --}}
{{-- Quick Links --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4 text-center justify-content-center">
            @php
            $links = [
                ['icon'=>'bi-newspaper','label'=>'آخر الأخبار','route'=>'news.index','color'=>'#1a3a5c'],
                ['icon'=>'bi-people','label'=>'اللجان','route'=>'committees.index','color'=>'#c8a84b'],
                ['icon'=>'bi-geo-alt','label'=>'الرحلات','route'=>'trips.index','color'=>'#198754'],
                ['icon'=>'bi-trophy','label'=>'حجز الملعب','route'=>'stadium.index','color'=>'#dc3545'],
                // الإضافة الجديدة هنا
                ['icon'=>'bi-hospital','label'=>'الرعاية الصحية','route'=>'healthcare.index','color'=>'#0dcaf0'],
            ];
            @endphp
            @foreach($links as $link)
            {{-- تم تغيير col-md-3 إلى col-md-2.4 أو col-md ليتناسب مع 5 عناصر --}}
            <div class="col-6 col-lg">
                <a href="{{ route($link['route']) }}" class="text-decoration-none">
                    <div class="card p-4 h-100 border-0 shadow-sm shadow-hover">
                        <div class="fs-1 mb-2" style="color:{{ $link['color'] }}"><i class="bi {{ $link['icon'] }}"></i></div>
                        <h6 class="fw-bold mb-0" style="color:{{ $link['color'] }}">{{ $link['label'] }}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Latest News --}}
@if($latestNews->count())
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title">آخر الأخبار</h2>
        <div class="row g-4">
            @foreach($latestNews as $article)
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
                        <p class="small text-muted mb-3">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}</p>
                        <a href="{{ route('news.show', $article->slug) }}" class="btn btn-sm btn-primary">اقرأ المزيد</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('news.index') }}" class="btn btn-outline-primary fw-bold">عرض جميع الأخبار</a>
        </div>
    </div>
</section>
@endif

{{-- Upcoming Trips --}}
@if($upcomingTrips->count())
<section class="py-5">
    <div class="container">
        <h2 class="section-title">رحلات قادمة</h2>
        <div class="row g-4">
            @foreach($upcomingTrips as $trip)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($trip->image_url)
                        <img src="{{ $trip->image_url }}" class="news-img" alt="{{ $trip->title }}">
                    @else
                        <div class="news-img d-flex align-items-center justify-content-center" style="background:#e9ecef">
                            <i class="bi bi-geo-alt fs-1 text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $trip->title }}</h6>
                        <p class="small text-muted mb-1"><i class="bi bi-calendar me-1"></i>{{ $trip->trip_date->format('d M Y') }}</p>
                        <p class="small text-muted mb-3"><i class="bi bi-tag me-1"></i>{{ number_format($trip->price) }} جنيه</p>
<a href="{{ route('trips.show', ['slug' => $trip->slug ?? $trip->id]) }}" class="btn btn-sm btn-primary">التفاصيل والحجز</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection