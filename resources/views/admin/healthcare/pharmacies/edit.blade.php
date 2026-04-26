@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">تعديل صيدلية</h3>

    <form method="POST" action="{{ route('admin.healthcare.pharmacies.update', $pharmacy) }}">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>الاسم</label>
            <input name="name" class="form-control" value="{{ $pharmacy->name }}">
        </div>

        <div class="mb-2">
            <label>العنوان</label>
            <input name="address" class="form-control" value="{{ $pharmacy->address }}">
        </div>

        <div class="mb-2">
            <label>رقم الهاتف</label>
            <input name="phone" class="form-control" value="{{ $pharmacy->phone }}">
        </div>

        <div class="mb-2">
            <label>نسبة الخصم (%)</label>
            <input name="discount_percent" type="number"
                   class="form-control"
                   value="{{ $pharmacy->discount_percent }}">
        </div>

        <div class="mb-2">
            <label>الحالة</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $pharmacy->is_active ? 'selected' : '' }}>نشط</option>
                <option value="0" {{ !$pharmacy->is_active ? 'selected' : '' }}>غير نشط</option>
            </select>
        </div>

        <button class="btn btn-primary mt-2">تحديث</button>

    </form>

</div>

@endsection