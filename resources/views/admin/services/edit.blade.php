@extends('layouts.admin')

@section('title','تعديل خدمة')

@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">✏️ تعديل خدمة: {{ $service->title }}</h3>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">رجوع للكل</a>
    </div>

    <!-- تأكد من إضافة enctype لرفع الصور -->
    <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow-sm p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">عنوان الخدمة</label>
                    <input name="title" value="{{ old('title', $service->title) }}" class="form-control @error('title') is-invalid @enderror">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">القسم</label>
                    <input name="category" value="{{ old('category', $service->category) }}" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">وصف مختصر</label>
                    <textarea name="description" class="form-control" rows="2">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">المحتوى التفصيلي</label>
                    <textarea name="content" class="form-control" rows="5">{{ old('content', $service->content) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">تغيير الصورة</label>
                    <input type="file" name="image" class="form-control mb-2">
                    @if($service->image)
                        <div class="mt-2">
                            <small class="text-muted d-block mb-1">الصورة الحالية:</small>
                            <img src="{{ asset($service->image) }}" width="100" class="rounded border shadow-sm">
                        </div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">ترتيب الظهور</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">رقم الواتساب</label>
                    <input name="whatsapp_number" value="{{ old('whatsapp_number', $service->whatsapp_number) }}" class="form-control" placeholder="مثال: 2010xxxxxx">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">رسالة الواتساب التلقائية</label>
                    <input name="whatsapp_message" value="{{ old('whatsapp_message', $service->whatsapp_message) }}" class="form-control">
                </div>

                <div class="col-12 mb-4">
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $service->is_active ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_active">تفعيل الخدمة في الموقع</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">
                💾 حفظ التعديلات
            </button>
        </div>
    </form>
</div>

@endsection
