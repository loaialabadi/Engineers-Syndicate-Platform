@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-4">تعديل بيانات الطبيب</h3>

    <form method="POST"
          action="{{ route('admin.healthcare.doctors.update', $doctor) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- الاسم --}}
        <div class="mb-3">
            <label class="form-label">اسم الطبيب *</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $doctor->name) }}"
                   required>
        </div>

        {{-- الوصف --}}
        <div class="mb-3">
            <label class="form-label">الوصف</label>

            <textarea name="description"
                      class="form-control"
                      rows="4"
                      placeholder="اكتب وصف عن الطبيب والخدمات الطبية...">{{ old('description', $doctor->description) }}</textarea>
        </div>

        {{-- التخصص --}}
        <div class="mb-3">
            <label class="form-label">التخصص</label>

            <input type="text"
                   name="specialty"
                   class="form-control"
                   value="{{ old('specialty', $doctor->specialty) }}"
                   placeholder="مثال: جراحة - باطنة - أسنان">
        </div>

        <div class="row">

            {{-- الهاتف --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">رقم الهاتف</label>

                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $doctor->phone) }}">
            </div>

            {{-- واتساب --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">واتساب</label>

                <input type="text"
                       name="whatsapp"
                       class="form-control"
                       value="{{ old('whatsapp', $doctor->whatsapp) }}">
            </div>

        </div>

        <div class="row">

            {{-- العنوان --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">العنوان</label>

                <input type="text"
                       name="address"
                       class="form-control"
                       value="{{ old('address', $doctor->address) }}">
            </div>

            {{-- المدينة --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">المدينة</label>

                <input type="text"
                       name="city"
                       class="form-control"
                       value="{{ old('city', $doctor->city) }}">
            </div>

        </div>

        {{-- رابط الخرائط --}}
        <div class="mb-3">
            <label class="form-label">رابط الموقع على الخرائط</label>

            <input type="url"
                   name="location_url"
                   class="form-control"
                   value="{{ old('location_url', $doctor->location_url) }}"
                   placeholder="Google Maps URL">
        </div>

        {{-- مواعيد العمل --}}
        <div class="mb-3">
            <label class="form-label">مواعيد العمل</label>

            <input type="text"
                   name="working_hours"
                   class="form-control"
                   value="{{ old('working_hours', $doctor->working_hours) }}"
                   placeholder="مثال: من 5 مساءً إلى 10 مساءً">
        </div>

        {{-- نسبة الخصم --}}
        <div class="mb-3">
            <label class="form-label">نسبة الخصم (%)</label>

            <input type="number"
                   name="discount_percent"
                   class="form-control"
                   min="0"
                   max="100"
                   value="{{ old('discount_percent', $doctor->discount_percent) }}">
        </div>

        {{-- الصورة الحالية --}}
        @if($doctor->image)
            <div class="mb-3">

                <label class="form-label d-block">الصورة الحالية</label>

                <img src="{{ asset('storage/' . $doctor->image) }}"
                     width="120"
                     class="rounded border">
            </div>
        @endif

        {{-- صورة جديدة --}}
        <div class="mb-3">
            <label class="form-label">تغيير الصورة</label>

            <input type="file"
                   name="image"
                   class="form-control">
        </div>

        {{-- الحالة --}}
        <div class="mb-3 form-check">

            <input type="checkbox"
                   name="is_active"
                   class="form-check-input"
                   value="1"
                   {{ old('is_active', $doctor->is_active) ? 'checked' : '' }}>

            <label class="form-check-label">
                نشط
            </label>

        </div>

        <button class="btn btn-primary px-4">
            تحديث البيانات
        </button>

    </form>

</div>

@endsection