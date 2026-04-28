@extends('layouts.public')

@section('content')

@php
    $defaultImage = asset('images/syndicate-default.png');
@endphp

<div class="container py-4">

    <h2 class="mb-4">الرعاية الصحية</h2>

    <!-- Search -->
    <form method="GET" class="mb-4">
        <input type="text" name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="ابحث باسم الطبيب أو المستشفى...">
    </form>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#doctors">الأطباء</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#hospitals">المستشفيات</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#pharmacies">الصيدليات</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#labs">المعامل</a>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ================= DOCTORS ================= --}}
        <div class="tab-pane fade show active" id="doctors">
            <div class="row">

                @forelse($doctors as $doctor)
                    <div class="col-md-4 mb-4">

                        <div class="card h-100 shadow-sm border-0 hover-shadow">

                            <img src="{{ $doctor->image_url }}"
                                 class="card-img-top"
                                 style="height:220px; object-fit:cover;">

                            <div class="card-body">

                                <h5>{{ $doctor->name }}</h5>

                                <p class="text-muted mb-2">
                                    {{ $doctor->specialty ?? 'بدون تخصص' }}
                                </p>

                                @if($doctor->address)
                                    <p class="small text-muted mb-2">
                                        📍 {{ $doctor->address }}
                                    </p>
                                @endif

                                <span class="badge bg-success mb-2">
                                    خصم {{ $doctor->discount_percent }}%
                                </span>

                                @if($doctor->phone)
                                    <div class="small mb-2">
                                        📞 <a href="tel:{{ $doctor->phone }}">{{ $doctor->phone }}</a>
                                    </div>
                                @endif

                                @php
                                    $phone = preg_replace('/[^0-9]/', '', $doctor->phone);
                                    if (!str_starts_with($phone, '20')) {
                                        $phone = '20' . ltrim($phone, '0');
                                    }
                                @endphp

                                <div class="d-flex gap-2">

                                    @if($doctor->phone)
                                        <a href="tel:{{ $doctor->phone }}"
                                           class="btn btn-outline-primary btn-sm w-50">
                                            اتصال
                                        </a>

                                        <a href="https://wa.me/{{ $phone }}"
                                           target="_blank"
                                           class="btn btn-success btn-sm w-50">
                                            واتساب
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center">لا يوجد أطباء</div>
                @endforelse

            </div>
        </div>

        {{-- ================= HOSPITALS ================= --}}
        <div class="tab-pane fade" id="hospitals">
            <div class="row">

                @forelse($hospitals as $hospital)
                    <div class="col-md-4 mb-4">

                        <div class="card h-100 shadow-sm border-0 hover-shadow">

                            <img src="{{$hospital->image_url}}"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover;">

                            <div class="card-body">

                                <h5>{{ $hospital->name }}</h5>

                                @if($hospital->address)
                                    <p class="text-muted small">📍 {{ $hospital->address }}</p>
                                @endif

                                @if($hospital->phone)
                                    <p>📞 {{ $hospital->phone }}</p>
                                @endif

                                <span class="badge bg-primary">
                                    خصم {{ $hospital->discount_percent }}%
                                </span>

                                <div class="d-flex gap-2 mt-2">

                                    @if($hospital->phone)
                                        <a href="tel:{{ $hospital->phone }}"
                                           class="btn btn-outline-primary btn-sm w-50">
                                            اتصال
                                        </a>

                                        @php
                                            $hphone = preg_replace('/[^0-9]/', '', $hospital->phone);
                                            if (!str_starts_with($hphone, '20')) {
                                                $hphone = '20' . ltrim($hphone, '0');
                                            }
                                        @endphp

                                        <a href="https://wa.me/{{ $hphone }}"
                                           target="_blank"
                                           class="btn btn-success btn-sm w-50">
                                            واتساب
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center">لا توجد مستشفيات</div>
                @endforelse

            </div>
        </div>

        {{-- ================= PHARMACIES ================= --}}
        <div class="tab-pane fade" id="pharmacies">
            <div class="row">

                @forelse($pharmacies as $pharmacy)
                    <div class="col-md-4 mb-4">

                        <div class="card h-100 shadow-sm border-0 hover-shadow">

                            <img src="{{$pharmacy->image_url}}"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover;">

                            <div class="card-body">

                                <h5>{{ $pharmacy->name }}</h5>

                                @if($pharmacy->address)
                                    <p class="text-muted small">📍 {{ $pharmacy->address }}</p>
                                @endif

                                @if($pharmacy->phone)
                                    <p>📞 {{ $pharmacy->phone }}</p>
                                @endif

                                <span class="badge bg-warning text-dark">
                                    خصم {{ $pharmacy->discount_percent }}%
                                </span>

                                <div class="d-flex gap-2 mt-2">

                                    @if($pharmacy->phone)
                                        <a href="tel:{{ $pharmacy->phone }}"
                                           class="btn btn-outline-primary btn-sm w-50">
                                            اتصال
                                        </a>

                                        @php
                                            $pphone = preg_replace('/[^0-9]/', '', $pharmacy->phone);
                                            if (!str_starts_with($pphone, '20')) {
                                                $pphone = '20' . ltrim($pphone, '0');
                                            }
                                        @endphp

                                        <a href="https://wa.me/{{ $pphone }}"
                                           target="_blank"
                                           class="btn btn-success btn-sm w-50">
                                            واتساب
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center">لا توجد صيدليات</div>
                @endforelse

            </div>
        </div>

        {{-- ================= LABS ================= --}}
        <div class="tab-pane fade" id="labs">
            <div class="row">

                @forelse($labs as $lab)
                    <div class="col-md-4 mb-4">

                        <div class="card h-100 shadow-sm border-0 hover-shadow">

                            <img src="{{ $lab->image_url }}"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover;">

                            <div class="card-body">

                                <h5>{{ $lab->name }}</h5>

                                @if($lab->working_hours)
                                    <p class="text-muted small">
                                        ⏰ {{ $lab->working_hours }}
                                    </p>
                                @endif

                                @if($lab->phone)
                                    <p>📞 {{ $lab->phone }}</p>
                                @endif

                                <span class="badge bg-danger">
                                    خصم {{ $lab->discount_percent }}%
                                </span>

                                <div class="d-flex gap-2 mt-2">

                                    @if($lab->phone)
                                        <a href="tel:{{ $lab->phone }}"
                                           class="btn btn-outline-primary btn-sm w-50">
                                            اتصال
                                        </a>

                                        @php
                                            $lphone = preg_replace('/[^0-9]/', '', $lab->phone);
                                            if (!str_starts_with($lphone, '20')) {
                                                $lphone = '20' . ltrim($lphone, '0');
                                            }
                                        @endphp

                                        <a href="https://wa.me/{{ $lphone }}"
                                           target="_blank"
                                           class="btn btn-success btn-sm w-50">
                                            واتساب
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center">لا توجد معامل</div>
                @endforelse

            </div>
        </div>

    </div>

</div>

@endsection