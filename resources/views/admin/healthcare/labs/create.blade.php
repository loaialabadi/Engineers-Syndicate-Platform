@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">إضافة معمل</h3>

    <form method="POST" action="{{ route('admin.healthcare.labs.store') }} " enctype="multipart/form-data">
        @csrf

        <div class="mb-2">
            <label>الاسم</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>العنوان</label>
            <input name="address" class="form-control">
        </div>

        <div class="mb-2">
            <label>رقم الهاتف</label>
            <input name="phone" class="form-control">
        </div>
        
        <div class="mb-2">
            <label>الصورة</label>
            <input name="image" type="file" class="form-control">   

        <div class="mb-2">
            <label>مواعيد العمل</label>
            <input name="working_hours" class="form-control" placeholder="مثال: 9 صباحاً - 10 مساءً">
        </div>

        <div class="mb-2">
            <label>نسبة الخصم (%)</label>
            <input name="discount_percent" type="number" min="0" max="100" class="form-control">
        </div>

        <div class="mb-2">
            <label>الحالة</label>
            <select name="is_active" class="form-control">
                <option value="1">نشط</option>
                <option value="0">غير نشط</option>
            </select>
        </div>

        <button class="btn btn-success mt-2">حفظ</button>

    </form>

</div>

@endsection