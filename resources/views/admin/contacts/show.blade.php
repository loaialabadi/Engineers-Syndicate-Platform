@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow p-4">
        <h4>تفاصيل الرسالة</h4>
        <hr>
        <p><strong>من:</strong> {{ $contact->name }} ({{ $contact->email }})</p>
        <p><strong>الهاتف:</strong> {{ $contact->phone }}</p>
        <p><strong>الموضوع:</strong> {{ $contact->subject }}</p>
        <p><strong>الرسالة:</strong></p>
        <div class="p-3 bg-light rounded">{{ $contact->message }}</div>

        @if($contact->attachment)
        <div class="mt-3">
            <strong>المرفق:</strong>
            <a href="{{ asset($contact->attachment) }}" target="_blank" class="btn btn-sm btn-outline-secondary">🔍 عرض المرفق</a>
        </div>
        @endif
    </div>
</div>
@endsection
