@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">إضافة صيدلية</h3>

    <form method="POST"
          action="{{ route('admin.healthcare.pharmacies.store') }}"
          enctype="multipart/form-data">

        @csrf

        {{-- الاسم --}}
        <div class="mb-3">
            <label>الاسم *</label>
            <input name="name" class="form-control" required>
        </div>

        {{-- الوصف --}}
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description"
                      class="form-control"
                      rows="4"></textarea>
        </div>

        {{-- التخصص --}}
        <div class="mb-3">
            <label>التخصص</label>
            <input name="specialty" class="form-control">
        </div>

        <div class="row">

            {{-- المدينة --}}
            <div class="col-md-6 mb-3">
                <label>المدينة</label>
                <input name="city" class="form-control">
            </div>

            {{-- العنوان --}}
            <div class="col-md-6 mb-3">
                <label>العنوان</label>
                <input name="address" class="form-control">
            </div>

        </div>

        <div class="row">

            {{-- الهاتف --}}
            <div class="col-md-6 mb-3">
                <label>رقم الهاتف</label>
                <input name="phone" class="form-control">
            </div>

            {{-- واتساب --}}
            <div class="col-md-6 mb-3">
                <label>واتساب</label>
                <input name="whatsapp" class="form-control">
            </div>

        </div>

        {{-- مواعيد العمل --}}
        <div class="mb-3">
            <label>مواعيد العمل</label>
            <input name="working_hours" class="form-control">
        </div>

        {{-- رابط الخرائط --}}
        <div class="mb-3">
            <label>رابط الموقع (Google Maps)</label>
            <input name="location_url" class="form-control">
        </div>

        {{-- نسبة الخصم --}}
        <div class="mb-3">
            <label>نسبة الخصم (%)</label>
            <input name="discount_percent"
                   type="number"
                   min="0"
                   max="100"
                   class="form-control">
        </div>

        {{-- الصورة --}}
        <div class="mb-3">
            <label>الصورة</label>
            <input name="image" type="file" class="form-control">
        </div>

        {{-- الحالة --}}
        <div class="mb-3 form-check">

            <input type="hidden" name="is_active" value="0">

            <input type="checkbox"
                   name="is_active"
                   value="1"
                   class="form-check-input"
                   checked>

            <label class="form-check-label">نشط</label>

        </div>

        <button class="btn btn-success px-4">حفظ</button>

    </form>

</div>

@endsection