@extends('layouts.admin')
@section('title','تعديل رحلة')
@section('page-title','تعديل الرحلة')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card p-4">
            <form action="{{ route('admin.trips.update', $trip) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.trips._form')
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-5"><i class="bi bi-save me-1"></i>حفظ التغييرات</button>
                    <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection