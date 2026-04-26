@if($errors->any())
<div class="alert alert-danger small mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif
<div class="mb-3">
    <label class="form-label fw-bold">عنوان الرحلة <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $trip->title ?? '') }}" required>
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-bold">الوجهة</label>
    <input type="text" name="destination" class="form-control" value="{{ old('destination', $trip->destination ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label fw-bold">الوصف <span class="text-danger">*</span></label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6" required>{{ old('description', $trip->description ?? '') }}</textarea>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label fw-bold">تاريخ المغادرة <span class="text-danger">*</span></label>
        <input type="date" name="trip_date" class="form-control @error('trip_date') is-invalid @enderror"
            value="{{ old('trip_date', isset($trip) ? $trip->trip_date->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">تاريخ العودة</label>
        <input type="date" name="return_date" class="form-control"
            value="{{ old('return_date', isset($trip) && $trip->return_date ? $trip->return_date->format('Y-m-d') : '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">السعر (جنيه) <span class="text-danger">*</span></label>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" min="0" step="0.01"
            value="{{ old('price', $trip->price ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">الحد الأقصى للمقاعد <span class="text-danger">*</span></label>
        <input type="number" name="max_seats" class="form-control" min="1"
            value="{{ old('max_seats', $trip->max_seats ?? 50) }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label fw-bold">الصورة</label>
        @if(isset($trip) && $trip->image_url)
            <div class="mb-2"><img src="{{ $trip->image_url }}" width="120" class="rounded border"></div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
</div>
<div class="mt-3 form-check form-switch">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
        {{ old('is_active', isset($trip) ? $trip->is_active : true) ? 'checked' : '' }}>
    <label class="form-check-label fw-bold" for="is_active">الرحلة متاحة</label>
</div>