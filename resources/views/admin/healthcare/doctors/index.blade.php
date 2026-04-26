@extends('layouts.admin')

@section('content')

<div class="container">

    <h3>الأطباء</h3>
<a href="{{ route('admin.healthcare.doctors.create') }}" class="btn btn-primary mb-3">
    إضافة طبيب
</a>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>التخصص</th>
                <th>الخصم</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
        @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->specialty }}</td>
                <td>{{ $doctor->discount_percent }}%</td>
                <td>
                    <a href="{{ route('admin.healthcare.doctors.edit', $doctor) }}" class="btn btn-sm btn-warning">تعديل</a>

                    <form method="POST" action="{{ route('admin.healthcare.doctors.destroy', $doctor) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

@endsection