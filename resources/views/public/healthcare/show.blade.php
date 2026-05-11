@extends('layouts.public')

@section('content')

@php
    $phone = preg_replace('/[^0-9]/', '', $item->phone ?? '');
    if ($phone && !str_starts_with($phone, '20')) {
        $phone = '20' . ltrim($phone, '0');
    }
@endphp

<div class="container py-4">

    <div class="card shadow-sm border-0">

        {{-- IMAGE --}}
        <img src="{{ $item->image_url }}"
             class="card-img-top"
             style="height:350px; object-fit:cover;">

        <div class="card-body">

            {{-- NAME --}}
            <h3 class="mb-2">{{ $item->name }}</h3>

            {{-- BADGE --}}
            <span class="badge bg-success mb-3">
                خصم {{ $item->discount_percent }}%
            </span>

            {{-- DESCRIPTION --}}
            @if($item->description)
                <p class="text-muted">
                    {{ $item->description }}
                </p>
            @endif

            <hr>

            {{-- DETAILS --}}
            <div class="row">

                <div class="col-md-6 mb-2">
                    📞 <strong>الهاتف:</strong> {{ $item->phone ?? '-' }}
                </div>

                <div class="col-md-6 mb-2">
                    🏙 <strong>المدينة:</strong> {{ $item->city ?? '-' }}
                </div>

                <div class="col-md-6 mb-2">
                    📍 <strong>العنوان:</strong> {{ $item->address ?? '-' }}
                </div>

                <div class="col-md-6 mb-2">
                    ⏰ <strong>المواعيد:</strong> {{ $item->working_hours ?? '-' }}
                </div>

            </div>

            <hr>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex gap-2 flex-wrap">

                {{-- CALL --}}
                @if($item->phone)
                    <a href="tel:{{ $item->phone }}"
                       class="btn btn-outline-primary">
                        📞 اتصال
                    </a>
                @endif

                {{-- WHATSAPP --}}
                @if($phone)
                    <a href="https://wa.me/{{ $phone }}"
                       target="_blank"
                       class="btn btn-success">
                        🟢 واتساب
                    </a>
                @endif

                {{-- MAP --}}
                @if($item->location_url)
                    <a href="{{ $item->location_url }}"
                       target="_blank"
                       class="btn btn-warning">
                        📍 الموقع على الخريطة
                    </a>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection