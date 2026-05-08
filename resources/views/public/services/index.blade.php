@extends('layouts.public')

@section('title','الخدمات النقابية')

@section('content')

<div class="container py-5">

    <h2 class="text-center fw-bold mb-5">الخدمات النقابية</h2>

    <div class="row g-4">

        @foreach($services as $service)

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card h-100 shadow-sm border-0">

@if($service->image)
    <img src="{{ asset($service->image) }}"
         class="card-img-top"
         style="height:180px; object-fit:cover;"
         alt="{{ $service->title }}">
@endif


                    <div class="card-body">

                        <h5 class="fw-bold">{{ $service->title }}</h5>

                        <p class="text-muted small">
                            {{ $service->description }}
                        </p>

                        <span class="badge bg-secondary mb-2">
                            {{ $service->category ?? 'خدمة' }}
                        </span>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a href="{{ route('services.show',$service->id) }}"
                           class="btn btn-primary w-100">
                            التفاصيل
                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection