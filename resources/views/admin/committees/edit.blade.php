@extends('layouts.admin')
@section('title','تعديل لجنة')
@section('page-title','تعديل اللجنة')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <form action="{{ route('admin.committees.update', $committee) }}" method="POST">
                @csrf @method('PUT')
                @include('admin.committees._form')
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-5"><i class="bi bi-save me-1"></i>حفظ التغييرات</button>
                    <a href="{{ route('admin.committees.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection