@if($errors->any())
<div class="alert alert-danger small mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="mb-3">
    <label class="form-label fw-bold">عنوان الخبر <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $news->title ?? '') }}" required>
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">مقدمة قصيرة</label>
    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">المحتوى الكامل <span class="text-danger">*</span></label>
    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content', $news->content ?? '') }}</textarea>
    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">الصورة</label>
    @if(isset($news) && $news->image_url)
        <div class="mb-2">
            <img src="{{ $news->image_url }}" width="160" class="rounded border">
            <small class="text-muted d-block mt-1">الصورة الحالية — ارفع صورة جديدة للاستبدال</small>
        </div>
    @endif
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-check form-switch">
    <input type="hidden" name="is_published" value="0">
    <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1"
        {{ old('is_published', isset($news) ? $news->is_published : false) ? 'checked' : '' }}>
    <label class="form-check-label fw-bold" for="is_published">نشر الخبر فوراً</label>
</div>