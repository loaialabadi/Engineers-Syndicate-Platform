@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">إضافة معمل</h3>

    <form method="POST" action="{{ route('admin.healthcare.labs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>الاسم *</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>التخصص</label>
            <input name="specialty" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>العنوان</label>
                <input name="address" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>المدينة</label>
                <input name="city" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>الهاتف</label>
                <input name="phone" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>واتساب</label>
                <input name="whatsapp" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>الصورة</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>مواعيد العمل</label>
            <input name="working_hours" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>الخصم %</label>
                <input type="number" name="discount_percent" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>رابط الخريطة</label>
                <input name="location_url" class="form-control">
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">نشط</label>
        </div>

        <button class="btn btn-success">حفظ</button>

    </form>

</div>

@endsection