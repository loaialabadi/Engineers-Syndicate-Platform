@extends('layouts.admin')

@section('title','تعديل خدمة')

@section('content')

<div class="container py-4">

    <h3 class="mb-4 fw-bold">✏️ تعديل الخدمة</h3>

    <form method="POST" action="{{ route('admin.services.update',$service->id) }}">
        @csrf
        @method('PUT')

        <div class="card p-4">

            <input name="title" value="{{ $service->title }}" class="form-control mb-3">

            <input name="category" value="{{ $service->category }}" class="form-control mb-3">

            <textarea name="description" class="form-control mb-3">{{ $service->description }}</textarea>

            <textarea name="content" class="form-control mb-3">{{ $service->content }}</textarea>

            <input name="whatsapp_number" value="{{ $service->whatsapp_number }}" class="form-control mb-3">

            <input name="whatsapp_message" value="{{ $service->whatsapp_message }}" class="form-control mb-3">

            <input name="sort_order" value="{{ $service->sort_order }}" class="form-control mb-3">

            <div class="form-check mb-3">
                <input type="checkbox" name="is_active"
                       class="form-check-input"
                       {{ $service->is_active ? 'checked' : '' }}>
                <label class="form-check-label">مفعل</label>
            </div>

            <button class="btn btn-primary w-100">
                تحديث
            </button>

        </div>
    </form>

</div>

@endsection