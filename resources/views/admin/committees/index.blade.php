@extends('layouts.admin')
@section('title','إدارة اللجان')
@section('page-title','إدارة اللجان')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">قائمة اللجان</h5>
    <a href="{{ route('admin.committees.create') }}" class="btn btn-primary fw-bold">
        <i class="bi bi-plus-lg me-1"></i>إضافة لجنة
    </a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>اسم اللجنة</th><th>المسؤول</th><th>الحالة</th><th>الترتيب</th><th>الإجراءات</th></tr>
            </thead>
            <tbody>
                @forelse($committees as $committee)
                <tr>
                    <td>{{ $committee->id }}</td>
                    <td><strong>{{ $committee->name }}</strong></td>
                    <td>{{ $committee->chairperson ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $committee->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $committee->is_active ? 'نشطة' : 'معطلة' }}
                        </span>
                    </td>
                    <td>{{ $committee->sort_order }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.committees.edit', $committee) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.committees.destroy', $committee) }}" method="POST" onsubmit="return confirm('حذف اللجنة؟')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">لا توجد لجان</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $committees->links() }}</div>
</div>
@endsection