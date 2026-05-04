@extends('layouts.public')

@section('content')
<div class="container py-5">
    <h2 class="section-title mb-5">لجان النقابة</h2>
    
    <div class="row g-4">
        @forelse($committees as $committee) 
            <div class="col-md-4">
                <!-- الكارت بالكامل قابل للضغط عبر JavaScript -->
                <div class="card h-100 p-4 border-0 shadow-sm shadow-hover" 
                     onclick="window.location='{{ route('committees.show', $committee->id) }}'" 
                     style="cursor: pointer; position: relative; transition: all 0.3s ease;">
                    
                    <!-- قسم الصورة -->
                    <div class="mb-3 text-center">
                        @if($committee->image)
                            <img src="{{ asset('storage/' . $committee->image) }}" 
                                 class="img-fluid rounded" 
                                 style="height: 150px; width: 100%; object-fit: cover;">
                        @else
                            <div style="color:#1a3a5c; font-size:2.5rem">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        @endif
                    </div>

                    <!-- قسم النصوص -->
                    <h5 class="fw-bold mb-1 text-dark">{{ $committee->name }}</h5>
                    
                    @if($committee->chairperson)
                        <p class="small text-muted mb-2">
                            <i class="bi bi-person-badge me-1"></i>{{ $committee->chairperson }}
                        </p>
                    @endif

                    @if($committee->description)
                         <p class="text-muted small mb-0">{{ Str::limit(strip_tags($committee->description), 80) }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-people fs-1 d-block mb-2"></i> لا توجد لجان حالياً.
            </div>
        @endforelse
    </div>
</div>

<style>
    /* تأثير جمالي عند مرور الماوس على الكارت */
    .shadow-hover:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important; 
    }
</style>
@endsection
