@extends('layouts.admin')

@section('title','حجوزات الملعب')
@section('page-title','إدارة حجوزات الملعب')

@section('content')

<div class="container">

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">

                <div class="col-md-4">
                    <select name="status" class="form-control">
                        <option value="">كل الحالات</option>
                        <option value="pending">معلق</option>
                        <option value="confirmed">مؤكد</option>
                        <option value="rejected">مرفوض</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <input type="date" name="date" class="form-control">
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">فلترة</button>
                </div>

            </form>
        </div>
    </div>


    <div>
        <a href="{{ route('admin.stadium.settings') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-gear me-1"></i> إعدادات الملعب
        </a>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الموبايل</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>

                            <form method="POST"
                                  action="{{ route('admin.stadium.bookings.status', $booking) }}">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                    <option value="pending">pending</option>
                                    <option value="confirmed">confirmed</option>
                                    <option value="rejected">rejected</option>
                                </select>

                                <button class="btn btn-sm btn-success">حفظ</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection