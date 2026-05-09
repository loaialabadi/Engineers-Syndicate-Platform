```blade
@extends('layouts.admin')

@section('title','لوحة التحكم')
@section('page-title','لوحة التحكم')

@section('content')

{{-- Stat Cards --}}
<div class="row g-4 mb-4">

    @php
        $cards = [

            [
                'label' => 'إجمالي الأخبار',
                'value' => $stats['total_news'],
                'icon'  => 'bi-newspaper',
                'bg'    => 'linear-gradient(135deg,#1a3a5c,#2d5a8e)'
            ],

            [
                'label' => 'إجمالي الرحلات',
                'value' => $stats['total_trips'],
                'icon'  => 'bi-geo-alt-fill',
                'bg'    => 'linear-gradient(135deg,#198754,#20c997)'
            ],

            [
                'label' => 'حجوزات الملعب',
                'value' => $stats['total_stadium_bookings'],
                'icon'  => 'bi-trophy-fill',
                'bg'    => 'linear-gradient(135deg,#c8a84b,#e0b85c)'
            ],

            [
                'label' => 'حجوزات الرحلات',
                'value' => $stats['total_trip_bookings'],
                'icon'  => 'bi-suitcase-fill',
                'bg'    => 'linear-gradient(135deg,#6f42c1,#9b59b6)'
            ],

            [
                'label' => 'حجوزات ملعب معلقة',
                'value' => $stats['pending_stadium'],
                'icon'  => 'bi-hourglass-split',
                'bg'    => 'linear-gradient(135deg,#fd7e14,#ffc107)'
            ],

            [
                'label' => 'حجوزات رحلات معلقة',
                'value' => $stats['pending_trips'],
                'icon'  => 'bi-clock-history',
                'bg'    => 'linear-gradient(135deg,#dc3545,#e74c3c)'
            ],

            [
                'label' => 'إجمالي اللجان',
                'value' => $stats['total_committees'] ?? 0,
                'icon'  => 'bi-people-fill',
                'bg'    => 'linear-gradient(135deg,#0d6efd,#3d8bfd)'
            ],

            [
                'label' => 'إجمالي خدمات النقابة',
                'value' => $stats['total_services'] ?? 0,
                'icon'  => 'bi-grid-fill',
                'bg'    => 'linear-gradient(135deg,#198754,#157347)'
            ],

            [
                'label' => 'إجمالي التعاقدات الطبية',
                'value' => $stats['total_healthcare'] ?? 0,
                'icon'  => 'bi-heart-pulse-fill',
                'bg'    => 'linear-gradient(135deg,#20c997,#0dcaf0)'
            ],

            [
                'label' => 'إجمالي الرسائل',
                'value' => $stats['total_messages'] ?? 0,
                'icon'  => 'bi-envelope-fill',
                'bg'    => 'linear-gradient(135deg,#6610f2,#8540f5)'
            ],

        ];
    @endphp

    @foreach($cards as $card)

        <div class="col-sm-6 col-xl-4">

            <div class="stat-card d-flex align-items-center gap-3 p-4 text-white shadow-sm"
                 style="background:{{ $card['bg'] }}; border-radius:16px; min-height:120px;">

                <div class="fs-1 opacity-75">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>

                <div>
                    <div class="fs-2 fw-bold lh-1">
                        {{ $card['value'] }}
                    </div>

                    <div class="small opacity-75 mt-2">
                        {{ $card['label'] }}
                    </div>
                </div>

            </div>

        </div>

    @endforeach

</div>

<div class="row g-4">

    {{-- Recent Stadium Bookings --}}
    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-trophy me-2 text-warning"></i>
                    آخر حجوزات الملعب
                </h6>

                <a href="{{ route('admin.stadium.bookings') }}"
                   class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>

            </div>

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>الاسم</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentStadiumBookings as $b)

                            <tr>

                                <td>{{ $b->name }}</td>

                                <td>
                                    <small>
                                        {{ $b->booking_date->format('d M') }}
                                    </small>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $b->status_badge_class }}">
                                        {{ $b->status }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    لا توجد حجوزات
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Recent Trip Bookings --}}
    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-suitcase me-2 text-primary"></i>
                    آخر حجوزات الرحلات
                </h6>

                <a href="{{ route('admin.bookings.trips') }}"
                   class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>

            </div>

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>الاسم</th>
                            <th>الرحلة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentTripBookings as $b)

                            <tr>

                                <td>{{ $b->name }}</td>

                                <td>
                                    <small>
                                        {{ Str::limit($b->trip?->title, 25) }}
                                    </small>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $b->status_badge_class }}">
                                        {{ $b->status }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    لا توجد حجوزات
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
```
