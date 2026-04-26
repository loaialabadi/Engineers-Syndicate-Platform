@extends('layouts.public')
@section('title','اللجان')
@section('content')
<div class="container py-5">
    <h2 class="section-title">لجان النقابة</h2>
    <div class="row g-4">
        @forelse($committees as $committee)
        <div class="col-md-4">
            <div class="card h-100 p-4">
                <div class="mb-3" style="color:#1a3a5c; font-size:2.5rem"><i class="bi bi-people-fill"></i></div>
                <h5 class="fw-bold mb-1">{{ $committee->name }}</h5>
                @if($committee->chairperson)
                    <p class="small text-muted mb-2"><i class="bi bi-person-badge me-1"></i>{{ $committee->chairperson }}</p>
                @endif
                @if($committee->description)
                    <p class="text-muted small">{{ $committee->description }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-people fs-1 d-block mb-2"></i>لا توجد لجان حالياً.
        </div>
        @endforelse
    </div>
</div>
@endsection