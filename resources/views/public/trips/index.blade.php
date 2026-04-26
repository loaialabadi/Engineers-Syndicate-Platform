@extends('layouts.public')
@section('title','الرحلات')
@section('content')
<div class="container py-5">
    <h2 class="section-title">الرحلات المتاحة</h2>
    <div class="row g-4">
        @forelse($trips as $trip)
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
                    @if($trip->destination)
                        <p class="small text-muted mb-1"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $trip->destination }}</p>
                    @endif
                    <p class="small text-muted mb-1"><i class="bi bi-calendar me-1"></i>{{ $trip->trip_date->format('d M Y') }}</p>
                    <p class="fw-bold" style="color:#c8a84b"><i class="bi bi-tag me-1"></i>{{ number_format($trip->price) }} جنيه</p>
                </div>
                <div class="card-footer bg-transparent border-0 pb-3">
                    <a href="{{ route('trips.show', $trip->slug) }}" class="btn btn-primary btn-sm">التفاصيل والحجز</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-geo-alt fs-1 d-block mb-2"></i>لا توجد رحلات متاحة حالياً.
        </div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center">{{ $trips->links() }}</div>
</div>
@endsection