@extends('layouts.public')
@section('title','حجز الملعب')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <h2 class="section-title">حجز ملعب النقابة</h2>
            <div class="card p-4 mb-4" style="background:linear-gradient(135deg,#1a3a5c,#2d5a8e);color:#fff;border:none">
                <div class="row text-center g-3">
                    <div class="col-4">
                        <i class="bi bi-clock fs-2" style="color:#c8a84b"></i>
                        <p class="small mb-0 mt-1">من 7ص حتى 10م</p>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-calendar-check fs-2" style="color:#c8a84b"></i>
                        <p class="small mb-0 mt-1">كل أيام الأسبوع</p>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-whatsapp fs-2" style="color:#c8a84b"></i>
                        <p class="small mb-0 mt-1">تأكيد عبر واتساب</p>
                    </div>
                </div>
            </div>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 small">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-calendar-plus me-2" style="color:#1a3a5c"></i>نموذج الحجز</h5>
                <form action="{{ route('stadium.book') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">رقم الهاتف <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">تاريخ الحجز <span class="text-danger">*</span></label>
                            <input type="date" name="booking_date" class="form-control @error('booking_date') is-invalid @enderror"
                                value="{{ old('booking_date') }}" min="{{ date('Y-m-d') }}" required>
                            @error('booking_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">وقت البدء <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time') }}" required>
                            @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">وقت الانتهاء <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time') }}" required>
                            @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">الغرض من الحجز</label>
                            <textarea name="purpose" class="form-control" rows="3">{{ old('purpose') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary fw-bold w-100 py-3">
                                <i class="bi bi-check2-circle me-2"></i>تأكيد الحجز والتواصل عبر واتساب
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection