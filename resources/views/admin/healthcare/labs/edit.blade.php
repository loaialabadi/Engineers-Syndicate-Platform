@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">تعديل معمل</h3>

    <form method="POST"
          action="{{ route('admin.healthcare.labs.update', $lab) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- الاسم --}}
        <div class="mb-3">
            <label>الاسم *</label>
            <input name="name"
                   class="form-control"
                   value="{{ old('name', $lab->name) }}"
                   required>
        </div>

        {{-- الوصف --}}
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $lab->description) }}</textarea>
        </div>

        {{-- التخصص --}}
        <div class="mb-3">
            <label>التخصص</label>
            <input name="specialty"
                   class="form-control"
                   value="{{ old('specialty', $lab->specialty) }}">
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>العنوان</label>
                <input name="address"
                       class="form-control"
                       value="{{ old('address', $lab->address) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>المدينة</label>
                <input name="city"
                       class="form-control"
                       value="{{ old('city', $lab->city) }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>رقم الهاتف</label>
                <input name="phone"
                       class="form-control"
                       value="{{ old('phone', $lab->phone) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>واتساب</label>
                <input name="whatsapp"
                       class="form-control"
                       value="{{ old('whatsapp', $lab->whatsapp) }}">
            </div>

        </div>

        {{-- مواعيد العمل --}}
        <div class="mb-3">
            <label>مواعيد العمل</label>
            <input name="working_hours"
                   class="form-control"
                   value="{{ old('working_hours', $lab->working_hours) }}">
        </div>

        {{-- رابط الخرائط --}}
        <div class="mb-3">
            <label>رابط الموقع (Google Maps)</label>
            <input name="location_url"
                   class="form-control"
                   value="{{ old('location_url', $lab->location_url) }}">
        </div>

        {{-- نسبة الخصم --}}
        <div class="mb-3">
            <label>نسبة الخصم (%)</label>
            <input name="discount_percent"
                   type="number"
                   min="0"
                   max="100"
                   class="form-control"
                   value="{{ old('discount_percent', $lab->discount_percent) }}">
        </div>

        {{-- الصورة الحالية --}}
        @if($lab->image)
            <div class="mb-3">
                <label class="d-block">الصورة الحالية</label>
                <img src="{{ asset('storage/' . $lab->image) }}"
                     width="120"
                     class="rounded border">
            </div>
        @endif

        {{-- تغيير الصورة --}}
        <div class="mb-3">
            <label>تغيير الصورة</label>
            <input name="image" type="file" class="form-control">
        </div>

        {{-- الحالة --}}
        <div class="form-check mb-3">

            <input type="hidden" name="is_active" value="0">

            <input type="checkbox"
                   name="is_active"
                   value="1"
                   class="form-check-input"
                   {{ old('is_active', $lab->is_active) ? 'checked' : '' }}>

            <label class="form-check-label">نشط</label>
        </div>

        <button class="btn btn-primary px-4">
            تحديث
        </button>

    </form>

</div>

@endsection