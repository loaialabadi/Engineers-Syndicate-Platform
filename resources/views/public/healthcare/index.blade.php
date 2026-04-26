@extends('layouts.public')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">الرعاية الصحية</h2>

    <!-- Search -->
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control" placeholder="ابحث باسم الطبيب أو المستشفى...">
    </form>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#doctors">الأطباء</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#hospitals">المستشفيات</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#pharmacies">الصيدليات</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#labs">المعامل</a></li>
    </ul>

    <div class="tab-content">

        <!-- Doctors -->
        <div class="tab-pane fade show active" id="doctors">
            <div class="row">
                @foreach($doctors as $doctor)
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5>{{ $doctor->name }}</h5>
                            <p>{{ $doctor->specialty }}</p>
                            <span class="badge bg-success">
                                خصم {{ $doctor->discount_percent }}%
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Hospitals -->
        <div class="tab-pane fade" id="hospitals">
            <div class="row">
                @foreach($hospitals as $hospital)
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5>{{ $hospital->name }}</h5>
                            <p>{{ $hospital->address }}</p>
                            <span class="badge bg-primary">
                                خصم {{ $hospital->discount_percent }}%
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pharmacies -->
        <div class="tab-pane fade" id="pharmacies">
            <div class="row">
                @foreach($pharmacies as $pharmacy)
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5>{{ $pharmacy->name }}</h5>
                            <span class="badge bg-warning">
                                خصم {{ $pharmacy->discount_percent }}%
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Labs -->
        <div class="tab-pane fade" id="labs">
            <div class="row">
                @foreach($labs as $lab)
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5>{{ $lab->name }}</h5>
                            <p>{{ $lab->working_hours }}</p>
                            <span class="badge bg-danger">
                                خصم {{ $lab->discount_percent }}%
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>

@endsection