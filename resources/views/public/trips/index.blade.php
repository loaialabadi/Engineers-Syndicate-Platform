@extends('layouts.public')
@section('title','الرحلات')

@section('content')
<div class="container py-5">

    <h2 class="section-title text-center mb-5">الرحلات المتاحة</h2>

    <div class="row g-4">

        @forelse($trips as $trip)

        <div class="col-md-4">
            <div class="card trip-card h-100 shadow-sm border-0">

                {{-- Image --}}
                <div class="trip-img-wrapper">

                    @if($trip->image_url)
                        <img src="{{ asset('storage/' . $trip->image_url) }}" 
                             alt="{{ $trip->title }}">
                    @else
                        <div class="no-img">
                            <i class="bi bi-geo-alt fs-1"></i>
                        </div>
                    @endif

                    {{-- price badge --}}
                    <div class="price-badge">
                        {{ number_format($trip->price) }} ج
                    </div>

                </div>

                {{-- Body --}}
                <div class="card-body">

                    <h5 class="fw-bold mb-2">
                        {{ $trip->title }}
                    </h5>

                    @if($trip->destination)
                        <p class="small text-muted mb-1">
                            <i class="bi bi-geo-alt-fill text-danger"></i>
                            {{ $trip->destination }}
                        </p>
                    @endif

                    <p class="small text-muted">
                        <i class="bi bi-calendar"></i>
                        {{ $trip->trip_date->format('d M Y') }}
                    </p>

                </div>

                {{-- Footer --}}
                <div class="card-footer bg-transparent border-0 pb-3">
                    <a href="{{ route('trips.show', $trip->slug) }}"
                       class="btn btn-primary w-100">
                        التفاصيل والحجز
                    </a>
                </div>

            </div>
        </div>

        @empty

        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-geo-alt fs-1 d-block mb-2"></i>
            لا توجد رحلات متاحة حالياً.
        </div>

        @endforelse

    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $trips->links() }}
    </div>

</div>

{{-- Styles --}}
<style>
.trip-card {
    border-radius: 15px;
    overflow: hidden;
    transition: 0.3s;
}

.trip-card:hover {
    transform: translateY(-5px);
}

/* Image */
.trip-img-wrapper {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.trip-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* no image */
.no-img {
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eee;
    color: #999;
}

/* price badge */
.price-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #c8a84b;
    color: #fff;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: bold;
}
</style>

@endsection