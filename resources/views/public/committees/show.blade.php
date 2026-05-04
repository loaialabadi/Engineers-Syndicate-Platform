@extends('layouts.public')

@section('title', $committee->name)

@section('content')
<div class="container py-5">
    <!-- مسار الانتقال (Breadcrumb) -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('committees.index') }}" class="text-decoration-none">اللجان</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $committee->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- قسم النصوص (اليمين) -->
        <div class="col-md-8">
            <h1 class="fw-bold mb-3" style="color: #1a3a5c;">{{ $committee->name }}</h1>
            
            @if($committee->chairperson)
                <div class="d-flex align-items-center mb-4 text-primary">
                    <i class="bi bi-person-badge fs-4 me-2"></i>
                    <h5 class="mb-0 fw-bold">رئيس اللجنة: {{ $committee->chairperson }}</h5>
                </div>
            @endif

            <hr>

            <div class="committee-content fs-5 mt-4 text-secondary" style="line-height: 1.8; text-align: justify;">
                @if($committee->description)
                    {!! nl2br(e($committee->description)) !!}
                @else
                    <p class="text-muted italic">لا يوجد وصف تفصيلي لهذه اللجنة حالياً.</p>
                @endif
            </div>
        </div>

        <!-- قسم الصورة (اليسار) -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
@if($committee->image && Storage::disk('public')->exists($committee->image))
    <img src="{{ asset('storage/' . $committee->image) }}" class="img-fluid">
@else
    <img src="{{ asset('images/default.png') }}" class="img-fluid">
@endif

                
                <div class="card-body bg-light text-center small text-muted">
                    <i class="bi bi-info-circle me-1"></i> معلومات معتمدة من نقابة المهندسين
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
