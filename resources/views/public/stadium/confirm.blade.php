@extends('layouts.public')

@section('title','تأكيد الحجز')

@section('content')

<div class="container py-5 text-center">
    <div class="card p-5 shadow">
        <h3 class="mb-3 text-success">✅ تم تسجيل طلب الحجز</h3>
        
        <p class="mb-2">
            رقم الحجز: 
            <strong>{{ $booking->booking_reference }}</strong>
        </p>

        <p>
            📅 {{ $booking->booking_date }} <br>
            ⏰ من {{ $booking->start_time }} إلى {{ $booking->end_time }}
        </p>

        <hr>

        <h5 class="mb-3">⚠️ الخطوة الأخيرة</h5>
        <p class="text-muted">
            اضغط على الزر لإرسال طلبك عبر واتساب لتأكيد الحجز
        </p>

        @php
            // فصل العملية المنطقية لتجنب خطأ الـ Parse
            $isEngineer = $booking->is_engineer ? 'نعم' : 'لا';
            
            // بناء النص باستخدام الربط التقليدي لضمان التوافق
            $text = "طلب حجز ملعب\n" .
                    "رقم: " . $booking->booking_reference . "\n" .
                    "الاسم: " . $booking->name . "\n" .
                    "الهاتف: " . $booking->phone . "\n" .
                    "المهندس: " . $isEngineer . "\n" .
                    "التاريخ: " . $booking->booking_date . "\n" .
                    "من: " . $booking->start_time . " إلى " . $booking->end_time;

            $encodedMessage = urlencode($text);
        @endphp

        <a href="https://wa.me/{{ $whatsapp }}?text={{ $encodedMessage }}"
           target="_blank"
           class="btn btn-success btn-lg mt-3">
            💬 اضغط هنا لتأكيد الحجز عبر واتساب
        </a>
    </div>
</div>

@endsection
