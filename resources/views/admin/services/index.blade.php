@extends('layouts.admin')

@section('title','إدارة الخدمات')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">الخدمات النقابية</h3>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            ➕ إضافة خدمة
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle text-center mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>اسم الخدمة</th>
                        <th>التصنيف</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>

                            <td>
                                @if($service->image)
                                    <img src="{{ asset('storage/'.$service->image) }}"
                                         width="50" height="50"
                                         style="object-fit:cover;border-radius:8px;">
                                @else
                                    ---
                                @endif
                            </td>

                            <td class="fw-bold">{{ $service->title }}</td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $service->category ?? 'عام' }}
                                </span>
                            </td>

                            <td>
                                @if($service->is_active)
                                    <span class="badge bg-success">مفعل</span>
                                @else
                                    <span class="badge bg-danger">غير مفعل</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.services.edit',$service->id) }}"
                                   class="btn btn-sm btn-warning">
                                    تعديل
                                </a>

                                <form action="{{ route('admin.services.destroy',$service->id) }}"
                                      method="POST"
                                      style="display:inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('حذف الخدمة؟')">
                                        حذف
                                    </button>
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