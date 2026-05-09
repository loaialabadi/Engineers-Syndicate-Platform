@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4">📩 رسائل التواصل الواردة</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>المرسل</th>
                        <th>نوع الطلب</th>
                        <th>الموضوع</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $msg->name }}</div>
                            <small class="text-muted">{{ $msg->phone }}</small>
                        </td>
                        <td><span class="badge bg-info text-dark">{{ $msg->type }}</span></td>
                        <td>{{ $msg->subject }}</td>
                        <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $msg->id) }}" class="btn btn-sm btn-primary">عرض</a>
                            <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $messages->links() }} <!-- الترقيم -->
        </div>
    </div>
</div>
@endsection
