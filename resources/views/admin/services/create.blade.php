@extends('layouts.admin')

@section('title','إضافة خدمة')

@section('content')

<div class="container py-4">

    <h3 class="mb-4 fw-bold">➕ إضافة خدمة جديدة</h3>

    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card p-4">

            <div class="mb-3">
                <label>اسم الخدمة</label>
                <input name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>التصنيف</label>
                <input name="category" class="form-control" placeholder="القيد / المعاشات / الرعاية">
            </div>

            <div class="mb-3">
                <label>وصف مختصر</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>تفاصيل الخدمة</label>
                <textarea name="content" class="form-control" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label>صورة</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label>رقم واتساب (اختياري)</label>
                <input name="whatsapp_number" class="form-control">
            </div>

            <div class="mb-3">
                <label>رسالة واتساب</label>
                <input name="whatsapp_message" class="form-control">
            </div>

            <div class="mb-3">
                <label>ترتيب العرض</label>
                <input name="sort_order" type="number" class="form-control" value="0">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" class="form-check-input" checked>
                <label class="form-check-label">مفعل</label>
            </div>

            <button class="btn btn-success w-100">
                حفظ الخدمة
            </button>

        </div>
    </form>

</div>

@endsection