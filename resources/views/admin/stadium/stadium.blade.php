@extends('layouts.admin')
@section('title','حجوزات الملعب')

@section('content')

<h3 class="mb-3">حجوزات الملعب</h3>

<div class="mb-3">
    <a href="?status=" class="btn btn-sm btn-outline-dark">الكل</a>
    <a href="?status=pending" class="btn btn-sm btn-warning">معلق</a>
    <a href="?status=confirmed" class="btn btn-sm btn-success">مؤكد</a>
    <a href="?status=rejected" class="btn btn-sm btn-danger">مرفوض</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>مهندس؟</th>
            <th>الحالة</th>
            <th>تغيير</th>
        </tr>
    </thead>
    <tbody>

    @foreach($bookings as $b)
    <tr>
        <td>{{ $b->booking_reference }}</td>
        <td>{{ $b->name }}</td>
        <td>{{ $b->booking_date }}</td>
        <td>{{ $b->start_time }} - {{ $b->end_time }}</td>
        <td>{{ $b->is_engineer ? 'نعم' : 'لا' }}</td>
        <td>
            <span class="badge bg-{{ $b->status_badge_class }}">
                {{ $b->status }}
            </span>
        </td>
        <td>
            <form method="POST" action="{{ route('admin.bookings.stadium.status',$b) }}">
                @csrf
                @method('PATCH')

                <select name="status" class="form-select mb-1">
                    <option value="pending">معلق</option>
                    <option value="confirmed">مؤكد</option>
                    <option value="rejected">مرفوض</option>
                </select>

                <button class="btn btn-sm btn-primary">حفظ</button>
            </form>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>

{{ $bookings->links() }}

@endsection