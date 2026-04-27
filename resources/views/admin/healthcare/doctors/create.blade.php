@extends('layouts.admin')

@section('content')

<div class="container">

    <h3>إضافة طبيب</h3>

    <form method="POST"
          action="{{ route('admin.healthcare.doctors.store') }}"
          enctype="multipart/form-data">

        @csrf

        <input name="name" class="form-control mb-2" placeholder="الاسم">

        <input name="specialty" class="form-control mb-2" placeholder="التخصص">
        <input name="phone" class="form-control mb-2" placeholder="رقم الهاتف">
        <input name="address" class="form-control mb-2" placeholder="العنوان">  
        

        <input name="discount_percent" class="form-control mb-2" placeholder="نسبة الخصم">

        <input name="image" type="file" class="form-control mb-2">

        <button class="btn btn-success">حفظ</button>

    </form>

</div>

@endsection