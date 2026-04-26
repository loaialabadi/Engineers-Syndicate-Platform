@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">المستشفيات</h3>

    <a href="{{ route('admin.healthcare.hospitals.create') }}" class="btn btn-primary mb-3">
        إضافة مستشفى
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>العنوان</th>
                <th>الخصم</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
        @forelse($hospitals as $hospital)
            <tr>
                <td>{{ $hospital->name }}</td>
                <td>{{ $hospital->address }}</td>
                <td>{{ $hospital->discount_percent }}%</td>
                <td>

                    <a href="{{ route('admin.healthcare.hospitals.edit', $hospital) }}"
                       class="btn btn-sm btn-warning">تعديل</a>

                    <form method="POST"
                          action="{{ route('admin.healthcare.hospitals.destroy', $hospital) }}"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">
                            حذف
                        </button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">
                    لا توجد بيانات
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>

    {{ $hospitals->links() }}

</div>

@endsection