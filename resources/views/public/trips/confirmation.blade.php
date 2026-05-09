@extends('layouts.public')
@section('title', 'تأكيد طلب الحجز')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 20px;">
                <div class="mb-4">
                    <div class="display-1 text-success"><i class="bi bi-check2-circle"></i></div>
                    <h2 class="fw-bold text-dark">تم تسجيل طلب الحجز بنجاح</h2>
                </div>

                <div class="bg-light rounded-3 p-4 mb-4 text-end">
                    <p class="mb-2 fs-5"><strong>رقم الحجز:</strong> <span class="text-primary fw-bold">{{ $booking->booking_reference }}</span></p>
                    <p class="mb-2"><strong>الرحلة:</strong> {{ $booking->trip->title }}</p>
                    <p class="mb-2"><strong>الاسم:</strong> {{ $booking->name }}</p>
                    <hr>
                    <p class="mb-2 text-muted small"><i class="bi bi-calendar3 me-1"></i> تاريخ الطلب: {{ $booking->created_at->format('Y-m-d') }}</p>
                    <p class="mb-0 text-muted small"><i class="bi bi-clock me-1"></i> الوقت: {{ $booking->created_at->format('H:i') }}</p>
                </div>

                <div class="alert alert-warning border-0 small mb-4">
                    <h6 class="fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> الخطوة الأخيرة</h6>
                    يجب الانضمام لجروب الواتساب الخاص بالرحلة لتأكيد حجزك واستلام التعليمات.
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ $whatsappDirectLink }}" 
                    target="_blank" 
                    class="btn btn-success btn-lg px-5 py-3 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-whatsapp me-2"></i> إرسال تفاصيل الحجز عبر واتساب
                    </a>

                    <a href="{{ route('trips.index') }}" class="btn btn-link text-muted mt-2">العودة للرئيسية</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body { background-color: #f4f7f6; }
    .card { border-top: 5px solid #198754 !important; }
</style>
@endsection
