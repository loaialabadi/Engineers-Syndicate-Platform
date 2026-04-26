@extends('layouts.admin')
@section('title','حجوزات الملعب')
@section('page-title','إدارة حجوزات الملعب')
@section('content')

<div class="d-flex gap-2 mb-4 flex-wrap">
    @foreach([''=>'الكل','pending'=>'معلق','confirmed'=>'مؤكد','rejected'=>'مرفوض'] as $val => $label)
    <a href="{{ route('admin.bookings.stadium', $val ? ['status'=>$val] : []) }}"
       class="btn btn-sm {{ request('status') == $val ? 'btn-primary' : 'btn-outline-secondary' }} fw-bold">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr><th>المرجع</th><th>الاسم</th><th>التاريخ</th><th>الوقت</th><th>الغرض</th><th>الحالة</th><th>الإجراءات</th></tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td><code class="small">{{ $booking->booking_reference }}</code></td>
                    <td>
                        <strong>{{ $booking->name }}</strong><br>
                        <small class="text-muted">{{ $booking->phone }}</small>
                    </td>
                    <td>{{ $booking->booking_date->format('d M Y') }}</td>
                    <td><small>{{ $booking->start_time }} — {{ $booking->end_time }}</small></td>
                    <td><small>{{ Str::limit($booking->purpose, 40) ?? '—' }}</small></td>
                    <td><span class="badge bg-{{ $booking->status_badge_class }}">{{ $booking->status }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $booking->id }}">
                            <i class="bi bi-gear"></i> تغيير الحالة
                        </button>
                    </td>
                </tr>

                {{-- Status Modal --}}
                <div class="modal fade" id="modal-{{ $booking->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">تحديث حالة الحجز</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.bookings.stadium.status', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <div class="modal-body">
                                    <p class="mb-3"><strong>{{ $booking->name }}</strong> — {{ $booking->booking_date->format('d M Y') }}</p>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">الحالة الجديدة</label>
                                        <select name="status" class="form-select">
                                            <option value="pending"   {{ $booking->status=='pending'   ? 'selected':'' }}>معلق</option>
                                            <option value="confirmed" {{ $booking->status=='confirmed' ? 'selected':'' }}>مؤكد</option>
                                            <option value="rejected"  {{ $booking->status=='rejected'  ? 'selected':'' }}>مرفوض</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ملاحظات للعميل</label>
                                        <textarea name="admin_notes" class="form-control" rows="3">{{ $booking->admin_notes }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-primary fw-bold">حفظ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">لا توجد حجوزات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $bookings->links() }}</div>
</div>
@endsection