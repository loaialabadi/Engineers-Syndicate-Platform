@extends('layouts.public')
@section('title', $trip->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- قسم تفاصيل الرحلة -->
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

            <div class="card p-4 mb-4 border-0 shadow-sm">
                <h5 class="fw-bold mb-3 border-bottom pb-2">تفاصيل الرحلة</h5>
                {!! $trip->description !!}
            </div>

            <a href="{{ route('trips.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-right me-1"></i> العودة للرحلات
            </a>
        </div>

        <!-- قسم نموذج الحجز -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-header py-3 text-center border-0" style="background:#1a3a5c; color:#fff">
                    <h5 class="mb-0 fw-bold">طلب حجز مقعد</h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success small">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('trips.book', $trip->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="أدخل اسمك" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">رقم الهاتف (واتساب) <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" placeholder="01xxxxxxxxx" required>
                        </div>
                        <div class="mb-3">
    <label class="form-label small fw-bold">الرقم القومي (14 رقم) <span class="text-danger">*</span></label>
    <input type="text" name="national_id" class="form-control @error('national_id') is-invalid @enderror" 
           value="{{ old('national_id') }}" maxlength="14" required>
    @error('national_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<div class="mb-3">
    <label class="form-label small fw-bold">رقم العضوية <span class="text-danger">*</span></label>
    <input type="text" name="membership_number" class="form-control @error('membership_number') is-invalid @enderror" 
           placeholder="أدخل رقم العضوية الخاص بك" required value="{{ old('membership_number') }}">
    
    @error('membership_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    <div class="form-text mt-1 small text-primary">يجب إدخال رقم العضوية لإتمام عملية الحجز.</div>
</div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">عدد المقاعد <span class="text-danger">*</span></label>
                            <input type="number" name="seats" class="form-control" value="1" min="1" max="{{ $trip->available_seats }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                            <i class="bi bi-send me-1"></i> إرسال طلب الحجز
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-light p-3">
                    <p class="small text-muted mb-0 text-center">
                        <i class="bi bi-shield-check me-1"></i> سيتم مراجعة طلبك والتواصل معك لتأكيد الدفع.
                    </p>
                </div>
            </div>

            <!-- بطاقة معلومات إضافية -->
            <div class="card mt-3 p-3 border-0 shadow-sm" style="background:#f8f9fa">
                @if($trip->return_date)
                    <p class="small mb-0 text-center"><i class="bi bi-calendar-check me-1"></i> <strong>تاريخ العودة:</strong> {{ $trip->return_date->format('d M Y') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
