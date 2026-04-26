@extends('layouts.admin')

@section('title', 'إدارة الرعاية الصحية')
@section('page-title', 'منظومة الرعاية الصحية')

@section('content')
<div class="row g-4">
    {{-- كارت الأطباء --}}
    <div class="col-md-3">
        <div class="card text-center p-4">
            <i class="bi bi-person-md mb-3 text-primary" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold">الأطباء</h5>
            <p class="text-muted small">إجمالي المسجلين: {{ $stats['doctors'] }}</p>
            <a href="{{ route('admin.healthcare.doctors.index') }}" class="btn btn-primary btn-sm w-100">إدارة الأطباء</a>
        </div>
    </div>

    {{-- كارت المستشفيات --}}
    <div class="col-md-3">
        <div class="card text-center p-4">
            <i class="bi bi-hospital mb-3 text-danger" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold">المستشفيات</h5>
            <p class="text-muted small">إجمالي الجهات: {{ $stats['hospitals'] }}</p>
            <a href="{{ route('admin.healthcare.hospitals.index') }}" class="btn btn-danger btn-sm w-100">إدارة المستشفيات</a>
        </div>
    </div>

    {{-- كارت الصيدليات --}}
    <div class="col-md-3">
        <div class="card text-center p-4">
            <i class="bi bi-capsule mb-3 text-success" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold">الصيدليات</h5>
            <p class="text-muted small">إجمالي الفروع: {{ $stats['pharmacies'] }}</p>
            <a href="{{ route('admin.healthcare.pharmacies.index') }}" class="btn btn-success btn-sm w-100">إدارة الصيدليات</a>
        </div>
    </div>

    {{-- كارت المعامل --}}
    <div class="col-md-3">
        <div class="card text-center p-4">
            <i class="bi bi-vial mb-3 text-warning" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold">المعامل</h5>
            <p class="text-muted small">إجمالي مراكز التحاليل: {{ $stats['labs'] }}</p>
            <a href="{{ route('admin.healthcare.labs.index') }}" class="btn btn-warning btn-sm w-100">إدارة المعامل</a>
        </div>
    </div>
</div>
@endsection
