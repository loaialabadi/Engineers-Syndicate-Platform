@if($errors->any())
<div class="alert alert-danger small mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif
<div class="mb-3">
    <label class="form-label fw-bold">اسم اللجنة <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $committee->name ?? '') }}" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-bold">رئيس اللجنة</label>
    <input type="text" name="chairperson" class="form-control"
        value="{{ old('chairperson', $committee->chairperson ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label fw-bold">الوصف</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $committee->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">صورة اللجنة</label>
    <input type="file" name="image" class="form-control"> {{-- يجب أن يكون الاسم image --}}
    
    @if(isset($committee) && $committee->image)
        <div class="mt-2">
            <small class="text-muted d-block mb-1">الصورة الحالية:</small>
            <img src="{{ asset('storage/' . $committee->image) }}" width="150" class="img-thumbnail">
        </div>
    @endif
</div>


<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">الترتيب</label>
        <input type="number" name="sort_order" class="form-control" min="0"
            value="{{ old('sort_order', $committee->sort_order ?? 0) }}">
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check form-switch">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                {{ old('is_active', isset($committee) ? $committee->is_active : true) ? 'checked' : '' }}>
            <label class="form-check-label fw-bold" for="is_active">اللجنة نشطة</label>
        </div>
    </div>
</div>