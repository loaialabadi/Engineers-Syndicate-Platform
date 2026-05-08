@extends('layouts.public')

@section('title', $service->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- بطاقة الخدمة -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                
                <!-- الصورة: متجاوبة مع تغطية كاملة -->
                @if($service->image)
    <img src="{{ asset($service->image) }}"
                         class="img-fluid w-100" 
                         style="max-height: 400px; object-fit: cover;" 
                         alt="{{ $service->title }}">
                @endif

                <div class="card-body p-4 p-md-5">
                    <!-- العنوان -->
                    <h1 class="fw-bold mb-3 text-dark">{{ $service->title }}</h1>
                    
                    <!-- الوصف المختصر -->
                    <p class="lead text-muted mb-4 pb-3 border-bottom">
                        {{ $service->description }}
                    </p>

                    <!-- المحتوى التفصيلي: استخدام lh-lg لراحة العين -->
                    <div class="service-content lh-lg text-secondary">
                        {!! nl2br(e($service->content)) !!}
                    </div>

                    <!-- قسم الواتساب -->
                    @if($service->has_whatsapp && $service->whatsapp_number)
                        @php
                            $msg = urlencode($service->whatsapp_message ?? 'أرغب في الاستفسار عن خدمة: ' . $service->title);
                        @endphp

                        <div class="mt-5 border-top pt-4 text-center text-md-start">
                            <h5 class="fw-bold mb-3">هل لديك استفسار؟</h5>
                            <a href="https://wa.me/{{ $service->whatsapp_number }}?text={{ $msg }}"
                               target="_blank"
                               class="btn btn-success btn-lg px-5 py-3 fw-bold rounded-pill shadow-sm">
                                <i class="bi bi-whatsapp me-2"></i> تواصل عبر واتساب الآن
                            </a>
                        </div>
                    @endif

                    <!-- زر العودة -->
                    <div class="mt-4">
                        <a href="{{ route('services.index') }}" class="btn btn-link text-decoration-none text-muted p-0">
                            <i class="bi bi-arrow-right me-1"></i> العودة لقائمة الخدمات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .service-content { font-size: 1.1rem; }
    /* تحسين شكل الزر ليتوافق مع الموبايل */
    @media (max-width: 768px) {
        .btn-lg { width: 100%; }
    }
</style>
@endsection
