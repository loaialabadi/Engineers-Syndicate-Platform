@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">تعديل مستشفى</h3>

    <form method="POST"
          action="{{ route('admin.healthcare.hospitals.update', $hospital) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- الاسم --}}
        <div class="mb-3">
            <label>الاسم *</label>
            <input name="name"
                   class="form-control"
                   value="{{ old('name', $hospital->name) }}"
                   required>
        </div>

        {{-- الوصف --}}
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $hospital->description) }}</textarea>
        </div>

        {{-- التخصص --}}
        <div class="mb-3">
            <label>التخصص</label>
            <input name="specialty"
                   class="form-control"
                   value="{{ old('specialty', $hospital->specialty) }}">
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>العنوان</label>
                <input name="address"
                       class="form-control"
                       value="{{ old('address', $hospital->address) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>المدينة</label>
                <input name="city"
                       class="form-control"
                       value="{{ old('city', $hospital->city) }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>رقم الهاتف</label>
                <input name="phone"
                       class="form-control"
                       value="{{ old('phone', $hospital->phone) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>واتساب</label>
                <input name="whatsapp"
                       class="form-control"
                       value="{{ old('whatsapp', $hospital->whatsapp) }}">
            </div>

        </div>

        {{-- الصورة --}}
        <div class="mb-3">
            <label>الصورة</label>
            <input name="image" type="file" class="form-control">
        </div>

        {{-- الصورة الحالية --}}
        @if($hospital->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $hospital->image) }}"
                     width="120"
                     class="rounded border">
            </div>
        @endif

        {{-- مواعيد العمل --}}
        <div class="mb-3">
            <label>مواعيد العمل</label>
            <input name="working_hours"
                   class="form-control"
                   value="{{ old('working_hours', $hospital->working_hours) }}">
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>نسبة الخصم (%)</label>
                <input name="discount_percent"
                       type="number"
                       class="form-control"
                       min="0"
                       max="100"
                       value="{{ old('discount_percent', $hospital->discount_percent) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>رابط الخرائط</label>
                <input name="location_url"
                       class="form-control"
                       value="{{ old('location_url', $hospital->location_url) }}">
            </div>

        </div>

        {{-- الحالة (FIXED & COMPATIBLE) --}}
        <div class="mb-3 form-check">

            <input type="hidden" name="is_active" value="0">

            <input type="checkbox"
                   name="is_active"
                   value="1"
                   class="form-check-input"
                   {{ old('is_active', $hospital->is_active ?? false) ? 'checked' : '' }}>

            <label class="form-check-label">نشط</label>

        </div>

        <button class="btn btn-primary px-4">
            تحديث
        </button>

    </form>

</div>

@endsection