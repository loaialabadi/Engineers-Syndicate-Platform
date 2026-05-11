@extends('layouts.public')

@section('content')

<div class="container py-4">

    <h3 class="mb-4">الرعاية الصحية</h3>

    {{-- FILTER --}}
    <form method="GET" class="row mb-4">

        <div class="col-md-3">
            <select name="type" class="form-control">
                <option value="">كل الأقسام</option>
                <option value="doctor" {{ request('type')=='doctor'?'selected':'' }}>أطباء</option>
                <option value="hospital" {{ request('type')=='hospital'?'selected':'' }}>مستشفيات</option>
                <option value="pharmacy" {{ request('type')=='pharmacy'?'selected':'' }}>صيدليات</option>
                <option value="lab" {{ request('type')=='lab'?'selected':'' }}>معامل</option>
            </select>
        </div>

        <div class="col-md-7">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="ابحث بالاسم...">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">بحث</button>
        </div>

    </form>

    {{-- GRID --}}
    <div class="row">

        {{-- DOCTORS --}}
        @foreach($doctors as $item)
            @include('public.healthcare.partials.card', ['item'=>$item, 'type'=>'doctor'])
        @endforeach

        {{-- HOSPITALS --}}
        @foreach($hospitals as $item)
            @include('public.healthcare.partials.card', ['item'=>$item, 'type'=>'hospital'])
        @endforeach

        {{-- PHARMACIES --}}
        @foreach($pharmacies as $item)
            @include('public.healthcare.partials.card', ['item'=>$item, 'type'=>'pharmacy'])
        @endforeach

        {{-- LABS --}}
        @foreach($labs as $item)
            @include('public.healthcare.partials.card', ['item'=>$item, 'type'=>'lab'])
        @endforeach

    </div>

</div>

@endsection