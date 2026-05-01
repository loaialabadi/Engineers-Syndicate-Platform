@extends('layouts.admin')

@section('title','إعدادات الملعب')
@section('page-title','إعدادات ملعب النقابة')

@section('content')

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.stadium.settings.update') }}">
                @csrf

                {{-- سعر الساعة --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">💰 سعر الساعة</label>
                    <input type="number"
                           name="price"
                           class="form-control"
                           value="{{ $price }}"
                           required>
                </div>

                {{-- رقم الواتساب --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">📲 رقم واتساب للتواصل</label>
                    <input type="text"
                           name="whatsapp"
                           class="form-control"
                           value="{{ $whatsapp }}"
                           required>
                </div>

                {{-- مواعيد التشغيل --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">⏰ وقت فتح الملعب</label>
                        <input type="time"
                               name="open_time"
                               class="form-control"
                               value="{{ $open_time }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">⏰ وقت غلق الملعب</label>
                        <input type="time"
                               name="close_time"
                               class="form-control"
                               value="{{ $close_time }}">
                    </div>
                </div>

                {{-- ملاحظات --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">📝 ملاحظات الحجز</label>
                    <textarea name="notes"
                              class="form-control"
                              rows="4">{{ $notes }}</textarea>
                </div>

                {{-- زر الحفظ --}}
                <button type="submit" class="btn btn-primary w-100">
                    حفظ الإعدادات
                </button>

            </form>

        </div>
    </div>

</div>

@endsection