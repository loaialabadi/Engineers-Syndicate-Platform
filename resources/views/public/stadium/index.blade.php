@extends('layouts.public')

@section('title','حجز ملعب النقابة')

@section('content')

<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <h2 class="text-center mb-4 fw-bold">حجز ملعب النقابة</h2>

            {{-- Info --}}
<div class="card p-3 p-md-4 mb-4 border-0 shadow-sm stadium-info-card">

    <div class="row text-center g-3 align-items-center">

        <div class="col-12 col-md-6">
            <div class="info-box">
                <div class="fs-3 mb-2">⏰</div>

                <div class="fw-bold mb-1">مواعيد العمل</div>

                <small>
                    من {{ $settings['stadium_open_time'] ?? '07:00' }}
                    إلى {{ $settings['stadium_close_time'] ?? '22:00' }}
                </small>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="info-box">
                <div class="fs-3 mb-2">📲</div>

                <div class="fw-bold mb-1">واتساب الحجز</div>

                <small>
                    {{ $settings['whatsapp_number'] ?? '---' }}
                </small>
            </div>
        </div>

    </div>

</div>

            {{-- اختيار التاريخ --}}
            <div class="card p-3 p-md-4 mb-4 shadow-sm">

                <form method="GET" action="{{ route('stadium.index') }}">

                    <label class="fw-bold mb-2">اختار اليوم</label>

                    <input type="date"
                           name="date"
                           value="{{ $date ?? '' }}"
                           min="{{ date('Y-m-d') }}"
                           class="form-control mb-3"
                           required>

                    <button class="btn btn-primary w-100">
                        عرض الساعات
                    </button>

                </form>

            </div>

            {{-- اليوم --}}
            @if(!empty($date))
                <div class="alert alert-info text-center fw-bold">
                    📅 {{ $dayName }} — {{ $date }}
                </div>
            @endif

            {{-- errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)
                        <div>{{ $e }}</div>
                    @endforeach
                </div>
            @endif

            {{-- لا يوجد ساعات --}}
            @if(!empty($date) && empty($slots))
                <div class="alert alert-warning text-center">
                    لا توجد ساعات متاحة في هذا اليوم
                </div>
            @endif

            {{-- slots --}}
            @if(!empty($slots))

            <div class="card p-3 p-md-4 shadow-sm">

                <form method="POST" action="{{ route('stadium.book') }}">
                    @csrf

                    <input type="hidden" name="booking_date" value="{{ $date }}">

                    <h5 class="mb-3">اختار الوقت</h5>

                    <div class="row g-2">

                        @foreach($slots as $slot)

                            <div class="col-6 col-md-4 col-lg-3">

                                @if($slot['booked'])

                                    <button class="btn btn-danger w-100 small" disabled>
                                        {{ $slot['start'] }}<br>
                                        <small>محجوز</small>
                                    </button>

                                @else

                                    @php
                                        $slotId = 'slot_' . $loop->index;
                                    @endphp

                                    <input type="checkbox"
                                           class="btn-check"
                                           name="slots[]"
                                           value="{{ $slot['start'].'-'.$slot['end'] }}"
                                           id="{{ $slotId }}">

                                    <label class="btn btn-outline-success w-100 small"
                                           for="{{ $slotId }}">
                                        {{ $slot['start'] }} - {{ $slot['end'] }}
                                    </label>

                                @endif

                            </div>

                        @endforeach

                    </div>

                    <hr>

                    {{-- بيانات المستخدم --}}
                    <h5 class="mb-3">بيانات الحجز</h5>

                    <div class="row g-2">

                        <div class="col-12">
                            <input name="name"
                                   class="form-control"
                                   placeholder="الاسم"
                                   required>
                        </div>

                        <div class="col-12">
                            <input name="phone"
                                   class="form-control"
                                   placeholder="رقم الهاتف"
                                   required>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="fw-bold mb-2">الصفة المهنية</label>

                            <div class="row g-2">

                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="is_engineer" id="eng_yes" value="1" checked>
                                    <label class="btn btn-outline-primary w-100 py-2" for="eng_yes">
                                        👷‍♂️<br>مهندس
                                    </label>
                                </div>

                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="is_engineer" id="eng_no" value="0">
                                    <label class="btn btn-outline-secondary w-100 py-2" for="eng_no">
                                        👤<br>زائر
                                    </label>
                                </div>

                            </div>
                        </div>

                    </div>

                    <button class="btn btn-success w-100 mt-4 py-2 fw-bold">
                        💬 تأكيد الحجز عبر واتساب
                    </button>

                </form>

            </div>

            @endif

        </div>
    </div>
</div>

<style>
.btn-check:checked + .btn {
    background-color: #198754 !important;
    color: #fff !important;
    border-color: #198754 !important;
}

.btn-outline-success {
    padding: 10px 5px;
    font-size: 0.9rem;
}

/* تحسين للموبايل */
@media (max-width: 576px) {
    .btn-outline-success {
        font-size: 0.8rem;
        padding: 8px 3px;
    }
}
</style>

@endsection