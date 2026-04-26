@extends('layouts.public')
@section('title', $trip->title)
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            @if($trip->image_url)
                <img src="{{ $trip->image_url }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height:420px;object-fit:cover" alt="{{ $trip->title }}">
            @endif
            <h2 class="fw-black mb-3">{{ $trip->title }}</h2>
            <div class="row g-3 mb-4">
                <div class="col-auto">
                    <span class="badge bg-primary py-2 px-3"><i class="bi bi-calendar me-1"></i>{{ $trip->trip_date->format('d M Y') }}</span>
                </div>
                @if($trip->destination)
                <div class="col-auto">
                    <span class="badge bg-secondary py-2 px-3"><i class="bi bi-geo-alt me-1"></i>{{ $trip->destination }}</span>
                </div>
                @endif
                <div class="col-auto">
                    <span class="badge py-2 px-3" style="background:#c8a84b"><i class="bi bi-tag me-1"></i>{{ number_format($trip->price) }} جنيه</span>
                </div>
                <div class="col-auto">
                    <span class="badge bg-info py-2 px-3"><i class="bi bi-people me-1"></i>{{ $trip->available_seats }} مقعد متاح</span>
                </div>
            </div>
            <div class="card p-4 mb-4">
                {!! $trip->description !!}
            </div>
            <a href="{{ $whatsappUrl }}" target="_blank" class="btn whatsapp-btn btn-lg px-5 fw-bold">
                <i class="bi bi-whatsapp me-2"></i>احجز الآن عبر واتساب
            </a>
            <a href="{{ route('trips.index') }}" class="btn btn-outline-secondary ms-2 btn-lg">
                <i class="bi bi-arrow-right me-1"></i>الرحلات
            </a>
        </div>
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card p-4 text-center" style="background:linear-gradient(135deg,#1a3a5c,#2d5a8e);color:#fff">
                <i class="bi bi-info-circle fs-1 mb-3" style="color:#c8a84b"></i>
                <h6 class="fw-bold">كيفية الحجز</h6>
                <p class="small opacity-75">اضغط على زر "احجز الآن" وسيتم توجيهك لواتساب مع تفاصيل الرحلة جاهزة. أكمل بياناتك وسيتواصل معك فريقنا.</p>
                @if($trip->return_date)
                    <hr style="border-color:rgba(255,255,255,.2)">
                    <p class="small mb-0"><i class="bi bi-calendar-check me-1"></i>تاريخ العودة: {{ $trip->return_date->format('d M Y') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection