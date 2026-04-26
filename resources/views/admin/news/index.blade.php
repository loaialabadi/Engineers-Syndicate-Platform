@extends('layouts.admin')
@section('title','إدارة الأخبار')
@section('page-title','إدارة الأخبار')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">قائمة الأخبار</h5>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary fw-bold">
        <i class="bi bi-plus-lg me-1"></i>إضافة خبر
    </a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th><th>الصورة</th><th>العنوان</th><th>الحالة</th><th>تاريخ النشر</th><th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $article)
                <tr class="{{ $article->trashed() ? 'table-secondary' : '' }}">
                    <td>{{ $article->id }}</td>
                    <td>
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" width="50" height="40" style="object-fit:cover;border-radius:6px">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:40px">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ Str::limit($article->title, 50) }}</strong>
                        @if($article->trashed())<span class="badge bg-secondary ms-1">محذوف</span>@endif
                    </td>
                    <td>
                        @if($article->is_published)
                            <span class="badge bg-success">منشور</span>
                        @else
                            <span class="badge bg-warning text-dark">مسودة</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $article->published_at?->format('d M Y') ?? '—' }}</small></td>
                    <td>
                        @if(!$article->trashed())
                        <div class="d-flex gap-1">
                            <form action="{{ route('admin.news.toggle-publish', $article) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $article->is_published ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $article->is_published ? 'إلغاء النشر' : 'نشر' }}">
                                    <i class="bi {{ $article->is_published ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-sm btn-outline-primary" title="تعديل">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="حذف">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">لا توجد أخبار</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $news->links() }}</div>
</div>
@endsection