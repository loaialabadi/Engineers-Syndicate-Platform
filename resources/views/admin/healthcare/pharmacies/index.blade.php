@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">الصيدليات</h3>

    <a href="{{ route('admin.healthcare.pharmacies.create') }}" class="btn btn-primary mb-3">
        إضافة صيدلية
    </a>

    <table class="table table-bordered align-middle">

        <thead>
            <tr>
                <th>الصورة</th>
                <th>الاسم</th>
                <th>المدينة</th>
                <th>العنوان</th>
                <th>الهاتف</th>
                <th>الخصم</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>

        @forelse($pharmacies as $pharmacy)

            <tr>

                {{-- الصورة --}}
                <td>
                    <img src="{{ $pharmacy->image_url }}"
                         width="50"
                         height="50"
                         class="rounded border">
                </td>

                {{-- الاسم --}}
                <td>{{ $pharmacy->name }}</td>

                {{-- المدينة --}}
                <td>{{ $pharmacy->city ?? '-' }}</td>

                {{-- العنوان --}}
                <td>{{ $pharmacy->address ?? '-' }}</td>

                {{-- الهاتف --}}
                <td>{{ $pharmacy->phone ?? '-' }}</td>

                {{-- الخصم --}}
                <td>{{ $pharmacy->discount_percent }}%</td>

                {{-- الحالة --}}
                <td>
                    @if($pharmacy->is_active)
                        <span class="badge bg-success">نشط</span>
                    @else
                        <span class="badge bg-secondary">غير نشط</span>
                    @endif
                </td>

                {{-- الإجراءات --}}
                <td class="d-flex gap-1">

                    <a href="{{ route('admin.healthcare.pharmacies.edit', $pharmacy) }}"
                       class="btn btn-warning btn-sm">
                        تعديل
                    </a>

                    <form method="POST"
                          action="{{ route('admin.healthcare.pharmacies.destroy', $pharmacy) }}">
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
                <td colspan="8" class="text-center">لا توجد بيانات</td>
            </tr>

        @endforelse

        </tbody>

    </table>

    {{ $pharmacies->links() }}

</div>

@endsection