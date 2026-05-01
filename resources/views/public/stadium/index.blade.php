@extends('layouts.public')

@section('title','حجز ملعب النقابة')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2 class="text-center mb-4">حجز ملعب النقابة</h2>

            {{-- Info --}}
            <div class="card p-4 mb-4 text-white border-0"
                 style="background:linear-gradient(135deg,#1a3a5c,#2d5a8e);">

                <div class="row text-center">

                    <div class="col-3">
                        ⏰ من {{ $settings['stadium_open_time'] ?? '07:00' }}
                        إلى {{ $settings['stadium_close_time'] ?? '22:00' }}
                    </div>

                    <div class="col-3">
                        💰 {{ $settings['stadium_price'] ?? 0 }} جنيه / ساعة
                    </div>

                    <div class="col-3">
                        📲 {{ $settings['whatsapp_number'] ?? '---' }}
                    </div>

                    <div class="col-3">
                        📞 {{ $settings['contact_phone'] ?? '---' }}
                    </div>

                </div>

            </div>

            {{-- اختيار التاريخ --}}
            <div class="card p-4 mb-4">

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

            {{-- no slots --}}
            @if(!empty($date) && empty($slots))
                <div class="alert alert-warning text-center">
                    لا توجد ساعات متاحة في هذا اليوم
                </div>
            @endif

            {{-- slots --}}
            @if(!empty($slots))

            <div class="card p-4">

                <form method="POST" action="{{ route('stadium.book') }}">
                    @csrf

                    <input type="hidden" name="booking_date" value="{{ $date }}">

                    <h5 class="mb-3">اختار الوقت</h5>

                    <div class="row">

                        @foreach($slots as $slot)

                            <div class="col-3 mb-2">

                                @if($slot['booked'])

                                    <button class="btn btn-danger w-100" disabled>
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
                                           id="{{ $slotId }}"
                                           autocomplete="off">

                                    <label class="btn btn-outline-success w-100"
                                           for="{{ $slotId }}">

                                        {{ $slot['start'] }} - {{ $slot['end'] }}

                                        <br>

                                        <small>
                                            {{ $settings['stadium_price'] ?? 0 }} جنيه
                                        </small>

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

                        <div class="col-12">
                            <select name="is_engineer" class="form-control">
                                <option value="1">مهندس</option>
                                <option value="0">غير مهندس</option>
                            </select>
                        </div>

                    </div>

                    <button class="btn btn-success w-100 mt-3">
                        تأكيد الحجز عبر واتساب
                    </button>

                </form>

            </div>

            @endif

        </div>
    </div>
</div>

{{-- UI fix --}}
<style>
.btn-check:checked + .btn {
    background-color: #198754 !important;
    color: #fff !important;
    border-color: #198754 !important;
}
</style>

@endsection