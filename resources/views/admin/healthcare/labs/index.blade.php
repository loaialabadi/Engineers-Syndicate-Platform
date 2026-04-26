@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">معامل التحاليل</h3>

    <a href="{{ route('admin.healthcare.labs.create') }}" class="btn btn-primary mb-3">
        إضافة معمل
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>العنوان</th>
                <th>الهاتف</th>
                <th>مواعيد العمل</th>
                <th>الخصم</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
        @forelse($labs as $lab)
            <tr>
                <td>{{ $lab->name }}</td>
                <td>{{ $lab->address }}</td>
                <td>{{ $lab->phone }}</td>
                <td>{{ $lab->working_hours }}</td>
                <td>{{ $lab->discount_percent }}%</td>
                <td>
                    @if($lab->is_active)
                        <span class="badge bg-success">نشط</span>
                    @else
                        <span class="badge bg-secondary">غير نشط</span>
                    @endif
                </td>
                <td>

                    <a href="{{ route('admin.healthcare.labs.edit', $lab) }}"
                       class="btn btn-warning btn-sm">تعديل</a>

                    <form method="POST"
                          action="{{ route('admin.healthcare.labs.destroy', $lab) }}"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('هل أنت متأكد؟')">
                            حذف
                        </button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $labs->links() }}

</div>

@endsection