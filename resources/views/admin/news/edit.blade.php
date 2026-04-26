@extends('layouts.admin')
@section('title','تعديل خبر')
@section('page-title','تعديل الخبر')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card p-4">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.news._form')
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-5">
                        <i class="bi bi-save me-1"></i>حفظ التغييرات
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection