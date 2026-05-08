@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-4">الإعدادات العامة</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf

        <div class="card mb-4">
            <div class="card-header">
                بيانات عامة
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label>اسم الموقع</label>
                    <input type="text"
                           name="site_name"
                           class="form-control"
                           value="{{ $settings['site_name'] ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>رقم التواصل</label>
                    <input type="text"
                           name="contact_phone"
                           class="form-control"
                           value="{{ $settings['contact_phone'] ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>رقم الواتساب</label>
                    <input type="text"
                           name="whatsapp_number"
                           class="form-control"
                           value="{{ $settings['whatsapp_number'] ?? '' }}">
                </div>

            </div>
        </div>

        <div class="card mb-4">

            <div class="card-header">
                إعدادات الملعب
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label>سعر الساعة</label>
                    <input type="number"
                           name="stadium_price"
                           class="form-control"
                           value="{{ $settings['stadium_price'] ?? '' }}">
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <label>وقت الفتح</label>
                        <input type="time"
                               name="stadium_open_time"
                               class="form-control"
                               value="{{ $settings['stadium_open_time'] ?? '09:00' }}">
                    </div>

                    <div class="col-md-6">
                        <label>وقت الغلق</label>
                        <input type="time"
                               name="stadium_close_time"
                               class="form-control"
                               value="{{ $settings['stadium_close_time'] ?? '02:00' }}">
                    </div>

                </div>

            </div>

        </div>

        <div class="card mb-4">

            <div class="card-header">
                إعدادات الرحلات
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label>واتساب الرحلات</label>

                    <input type="text"
                           name="trips_whatsapp"
                           class="form-control"
                           value="{{ $settings['trips_whatsapp'] ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>ملاحظات الرحلات</label>

                    <textarea name="trips_notes"
                              class="form-control">{{ $settings['trips_notes'] ?? '' }}</textarea>
                </div>

            </div>

        </div>

        <button class="btn btn-primary">
            حفظ الإعدادات
        </button>

    </form>

</div>

@endsection