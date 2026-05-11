@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">تعديل صيدلية</h3>

    <form method="POST"
          action="{{ route('admin.healthcare.pharmacies.update', $pharmacy) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- الاسم --}}
        <div class="mb-3">
            <label>الاسم *</label>
            <input name="name"
                   class="form-control"
                   value="{{ old('name', $pharmacy->name) }}">
        </div>

        {{-- الوصف --}}
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $pharmacy->description) }}</textarea>
        </div>

        {{-- التخصص --}}
        <div class="mb-3">
            <label>التخصص</label>
            <input name="specialty"
                   class="form-control"
                   value="{{ old('specialty', $pharmacy->specialty) }}">
        </div>

        <div class="row">

            {{-- المدينة --}}
            <div class="col-md-6 mb-3">
                <label>المدينة</label>
                <input name="city"
                       class="form-control"
                       value="{{ old('city', $pharmacy->city) }}">
            </div>

            {{-- العنوان --}}
            <div class="col-md-6 mb-3">
                <label>العنوان</label>
                <input name="address"
                       class="form-control"
                       value="{{ old('address', $pharmacy->address) }}">
            </div>

        </div>

        <div class="row">

            {{-- الهاتف --}}
            <div class="col-md-6 mb-3">
                <label>رقم الهاتف</label>
                <input name="phone"
                       class="form-control"
                       value="{{ old('phone', $pharmacy->phone) }}">
            </div>

            {{-- واتساب --}}
            <div class="col-md-6 mb-3">
                <label>واتساب</label>
                <input name="whatsapp"
                       class="form-control"
                       value="{{ old('whatsapp', $pharmacy->whatsapp) }}">
            </div>

        </div>

        {{-- مواعيد العمل --}}
        <div class="mb-3">
            <label>مواعيد العمل</label>
            <input name="working_hours"
                   class="form-control"
                   value="{{ old('working_hours', $pharmacy->working_hours) }}">
        </div>

        {{-- رابط الخرائط --}}
        <div class="mb-3">
            <label>رابط الموقع</label>
            <input name="location_url"
                   class="form-control"
                   value="{{ old('location_url', $pharmacy->location_url) }}">
        </div>

        {{-- نسبة الخصم --}}
        <div class="mb-3">
            <label>نسبة الخصم (%)</label>
            <input name="discount_percent"
                   type="number"
                   class="form-control"
                   min="0"
                   max="100"
                   value="{{ old('discount_percent', $pharmacy->discount_percent) }}">
        </div>

        {{-- الصورة الحالية --}}
        @if($pharmacy->image)
            <div class="mb-3">
                <label>الصورة الحالية</label><br>
                <img src="{{ asset('storage/' . $pharmacy->image) }}"
                     width="120"
                     class="rounded border">
            </div>
        @endif

        {{-- صورة جديدة --}}
        <div class="mb-3">
            <label>تغيير الصورة</label>
            <input type="file" name="image" class="form-control">
        </div>

        {{-- الحالة --}}
        <div class="mb-3 form-check">

            <input type="hidden" name="is_active" value="0">

            <input type="checkbox"
                   name="is_active"
                   value="1"
                   class="form-check-input"
                   {{ old('is_active', $pharmacy->is_active) ? 'checked' : '' }}>

            <label class="form-check-label">نشط</label>

        </div>

        <button class="btn btn-primary px-4">
            تحديث
        </button>

    </form>

</div>

@endsection