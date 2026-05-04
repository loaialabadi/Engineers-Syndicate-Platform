@extends('layouts.admin')
@section('title','إضافة لجنة')
@section('page-title','إضافة لجنة جديدة')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <form action="{{ route('admin.committees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.committees._form')
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-5"><i class="bi bi-save me-1"></i>حفظ</button>
                    <a href="{{ route('admin.committees.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection