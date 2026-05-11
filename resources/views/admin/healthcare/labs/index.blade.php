@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">معامل التحاليل</h3>

    <a href="{{ route('admin.healthcare.labs.create') }}" class="btn btn-primary mb-3">
        إضافة معمل
    </a>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>الصورة</th>
                <th>الاسم</th>
                <th>التخصص</th>
                <th>المدينة</th>
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

                {{-- الصورة --}}
                <td>
                    @if($lab->image)
                        <img src="{{ asset('storage/' . $lab->image) }}"
                             width="50"
                             height="50"
                             class="rounded">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                {{-- الاسم --}}
                <td>{{ $lab->name }}</td>

                {{-- التخصص --}}
                <td>{{ $lab->specialty ?? '-' }}</td>

                {{-- المدينة --}}
                <td>{{ $lab->city ?? '-' }}</td>

                {{-- العنوان --}}
                <td>{{ $lab->address ?? '-' }}</td>

                {{-- الهاتف --}}
                <td>{{ $lab->phone ?? '-' }}</td>

                {{-- مواعيد العمل --}}
                <td>{{ $lab->working_hours ?? '-' }}</td>

                {{-- الخصم --}}
                <td>{{ $lab->discount_percent }}%</td>

                {{-- الحالة --}}
                <td>
                    @if($lab->is_active)
                        <span class="badge bg-success">نشط</span>
                    @else
                        <span class="badge bg-secondary">غير نشط</span>
                    @endif
                </td>

                {{-- الإجراءات --}}
                <td class="d-flex gap-1">

                    <a href="{{ route('admin.healthcare.labs.edit', $lab) }}"
                       class="btn btn-warning btn-sm">
                        تعديل
                    </a>

                    <form method="POST"
                          action="{{ route('admin.healthcare.labs.destroy', $lab) }}">
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
                <td colspan="10" class="text-center">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $labs->links() }}

</div>

@endsection