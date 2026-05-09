@extends('layouts.public')

@section('title', $service->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- بطاقة الخدمة -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                
                <!-- الصورة: متجاوبة مع تغطية كاملة -->
<!-- الصورة: تظهر بالكامل مع خلفية خفيفة إذا كانت المقاسات مختلفة -->
@if($service->image)
    <div class="service-image-container">
        <img src="{{ asset($service->image) }}"
             class="service-main-image" 
             alt="{{ $service->title }}">
    </div>
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
      /* الحاوية: تمنع خروج الصورة عن الحدود المخصصة لها */
    .service-image-container {
        width: 100%;
        height: 400px; /* يمكنك تعديل الارتفاع حسب رغبتك */
        background-color: #f8f9fa;
        overflow: hidden; /* ضروري لقص الصورة الزائدة عند الزووم */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-bottom: 1px solid #eee;
    }

    /* الصورة في وضعها الطبيعي */
    .service-main-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* تظهر كاملة داخل الـ 400px */
        transition: transform 0.5s ease; /* تنعيم الحركة */
        cursor: zoom-in;
    }

    /* التأثير عند مرور الماوس: تكبير الصورة لتظهر تفاصيلها */
    .service-image-container:hover .service-main-image {
        transform: scale(1.5); /* يكبر الصورة بمقدار مرة ونصف */
        object-fit: cover; /* اختيار اختياري: يجعلها تملأ الفراغات عند الزووم */
    }

    /* تحسين للموبايل: تقليل الارتفاع قليلًا */
    @media (max-width: 768px) {
        .service-image-container {
            height: 250px;
        }
        /* نلغي التكبير في الموبايل لأنه يعتمد على اللمس */
        .service-image-container:hover .service-main-image {
            transform: none;
        }
    }
</style>

@endsection
