@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">تعديل مستشفى</h3>

    <form method="POST" action="{{ route('admin.healthcare.hospitals.update', $hospital) }}">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>الاسم</label>
            <input name="name" class="form-control" value="{{ $hospital->name }}">
        </div>

        <div class="mb-2">
            <label>العنوان</label>
            <input name="address" class="form-control" value="{{ $hospital->address }}">
        </div>

        <div class="mb-2">
            <label>الصورة</label>
            <input name="image" type="file" class="form-control">
        </div>  

    

        <div class="mb-2">
            <label>رقم الهاتف</label>
            <input name="phone" class="form-control" value="{{ $hospital->phone }}">
        </div>

        <div class="mb-2">
            <label>نسبة الخصم (%)</label>
            <input name="discount_percent" type="number"
                   class="form-control"
                   value="{{ $hospital->discount_percent }}">
        </div>

        <div class="mb-2">
            <label>الحالة</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $hospital->is_active ? 'selected' : '' }}>نشط</option>
                <option value="0" {{ !$hospital->is_active ? 'selected' : '' }}>غير نشط</option>
            </select>
        </div>

        <button class="btn btn-primary mt-2">تحديث</button>

    </form>

</div>

@endsection