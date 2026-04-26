@extends('layouts.admin')
@section('title','إدارة الرحلات')
@section('page-title','إدارة الرحلات')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">قائمة الرحلات</h5>
    <a href="{{ route('admin.trips.create') }}" class="btn btn-primary fw-bold">
        <i class="bi bi-plus-lg me-1"></i>إضافة رحلة
    </a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>العنوان</th><th>التاريخ</th><th>السعر</th><th>المقاعد</th><th>الحالة</th><th>الإجراءات</th></tr>
            </thead>
            <tbody>
                @forelse($trips as $trip)
                <tr>
                    <td>{{ $trip->id }}</td>
                    <td><strong>{{ Str::limit($trip->title, 40) }}</strong></td>
                    <td><small>{{ $trip->trip_date->format('d M Y') }}</small></td>
                    <td>{{ number_format($trip->price) }} ج</td>
                    <td><small>{{ $trip->available_seats }} / {{ $trip->max_seats }}</small></td>
                    <td>
                        <span class="badge {{ $trip->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $trip->is_active ? 'نشطة' : 'معطلة' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.trips.edit', $trip) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" onsubmit="return confirm('حذف الرحلة؟')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">لا توجد رحلات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $trips->links() }}</div>
</div>
@endsection