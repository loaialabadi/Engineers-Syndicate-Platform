<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'نقابة المهندسين') - المنصة الرقمية</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --primary: #16324f;
            --secondary: #d4af37;
            --light-bg: #f5f7fa;
            --text-dark: #1e293b;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background:
                radial-gradient(circle at top right, #eef4ff 0, #f5f7fa 40%),
                #f5f7fa;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        /* ================= NAVBAR ================= */

        .navbar {
            background: rgba(22, 50, 79, .92) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 14px 0;
            transition: .3s;
            z-index: 999;
        }

        .navbar.scrolled {
            box-shadow: 0 8px 30px rgba(0, 0, 0, .12);
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.4rem;
            color: #fff !important;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, .88) !important;
            font-weight: 700;
            transition: .3s;
            border-radius: 10px;
            padding: 10px 14px !important;
        }

        .navbar .nav-link:hover {
            color: var(--secondary) !important;
            background: rgba(255, 255, 255, .06);
        }

        /* ================= HERO ================= */

        .hero-section {
            position: relative;
            overflow: hidden;
            padding: 120px 0;
            background:
                linear-gradient(rgba(22, 50, 79, .90),
                    rgba(22, 50, 79, .95)),
                url('/images/engineers-bg.jpg');

            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 900;
            line-height: 1.4;
        }

        .hero-text {
            font-size: 1.15rem;
            opacity: .92;
            line-height: 2;
        }

        /* ================= SECTION ================= */

        .section-title {
            font-weight: 900;
            color: var(--primary);
            position: relative;
            margin-bottom: 2rem;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 70px;
            height: 4px;
            border-radius: 30px;
            background: var(--secondary);
            margin-top: 10px;
        }

        /* ================= CARDS ================= */

        .card {
            border: none;
            border-radius: 22px;
            overflow: hidden;
            transition: .35s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            background: #fff;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .12);
        }

        .card img {
            transition: .4s;
        }

        .card:hover img {
            transform: scale(1.04);
        }

        /* ================= BUTTONS ================= */

        .btn {
            border-radius: 14px;
            font-weight: 700;
            padding: 10px 20px;
            transition: .3s;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: #10263c;
            border-color: #10263c;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: var(--secondary);
            border-color: var(--secondary);
            color: #fff;
        }

        .btn-warning:hover {
            background: #b9962e;
            border-color: #b9962e;
            color: #fff;
        }

        .btn-outline-light:hover {
            color: var(--primary) !important;
        }

        .whatsapp-btn {
            background: #25d366;
            border-color: #25d366;
            color: #fff;
            font-weight: 800;
        }

        .whatsapp-btn:hover {
            background: #1faa50;
            border-color: #1faa50;
            color: #fff;
        }

        /* ================= NEWS IMAGE ================= */

        .news-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* ================= BADGES ================= */

        .badge-published {
            background: #198754;
        }

        /* ================= FOOTER ================= */

        footer {
            background: var(--primary);
            color: rgba(255, 255, 255, .85);
            padding: 60px 0 20px;
            margin-top: 80px;
        }

        footer h5,
        footer h6 {
            color: #fff;
            font-weight: 800;
        }

        footer a {
            color: rgba(255, 255, 255, .8);
            transition: .3s;
        }

        footer a:hover {
            color: var(--secondary);
            padding-right: 4px;
        }

        /* ================= FORM ================= */

        .form-control {
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid #dbe2ea;
        }

        .form-control:focus {
            box-shadow: 0 0 0 .15rem rgba(22, 50, 79, .12);
            border-color: var(--primary);
        }

        /* ================= SLOT ACTIVE ================= */

        .btn-check:checked + .btn {
            background: #198754 !important;
            color: #fff !important;
            border-color: #198754 !important;
        }

        /* ================= FLOATING WHATSAPP ================= */

        .floating-whatsapp {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: #25d366;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            z-index: 9999;
            box-shadow: 0 10px 30px rgba(37, 211, 102, .35);
            transition: .3s;
        }

        .floating-whatsapp:hover {
            transform: scale(1.08);
            color: #fff;
        }

        /* ================= ALERTS ================= */

        .alert {
            border: none;
            border-radius: 0;
            font-weight: 600;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:992px) {

            .hero-section {
                padding: 90px 0;
                text-align: center;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-text {
                font-size: 1rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }
        }

        @media(max-width:768px) {

            .hero-section {
                padding: 70px 0;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .card {
                border-radius: 18px;
            }

            footer {
                text-align: center;
            }

            .navbar .nav-link {
                margin-bottom: 6px;
            }

            .floating-whatsapp {
                width: 56px;
                height: 56px;
                font-size: 26px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

{{-- ================= NAVBAR ================= --}}

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">

    <div class="container-fluid px-lg-5">

        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-building me-1" style="color:var(--secondary)"></i>
            نقابة المهندسين - قنا
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMenu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <ul class="navbar-nav ms-auto gap-lg-2">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i>
                        الرئيسية
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">
                        <i class="bi bi-newspaper me-1"></i>
                        الأخبار
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('committees.index') }}">
                        <i class="bi bi-people me-1"></i>
                        اللجان
                    </a>
                </li>

                                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">
                        <i class="bi bi-people me-1"></i>
                        خدمات النقابه 
                    </a>
                </li>
                


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('healthcare.index') }}">
                        <i class="bi bi-heart-pulse me-1"></i>
                        الرعاية الصحية
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('trips.index') }}">
                        <i class="bi bi-geo-alt me-1"></i>
                        الرحلات
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('stadium.index') }}">
                        <i class="bi bi-trophy me-1"></i>
                        حجز الملعب
                    </a>
                </li>


               
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}">
                        <i class="bi bi-envelope me-1"></i>
                        تواصل معنا
                    </a>
                </li>   

            </ul>

            <div class="ms-lg-3 mt-3 mt-lg-0">

                @auth

                    @if(auth()->user()->isAdmin())

                        <a href="{{ route('admin.dashboard') }}"
                           class="btn btn-warning fw-bold">

                            <i class="bi bi-speedometer2 me-1"></i>
                            لوحة التحكم

                        </a>

                    @endif

                @else

                    <a href="{{ route('login') }}"
                       class="btn btn-outline-light fw-bold">

                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        تسجيل الدخول

                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>

{{-- ================= FLASH MESSAGES ================= --}}

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show text-center mb-0">

    <i class="bi bi-check-circle me-1"></i>

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show text-center mb-0">

    <i class="bi bi-exclamation-circle me-1"></i>

    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif

{{-- ================= MAIN CONTENT ================= --}}

@yield('content')

{{-- ================= FOOTER ================= --}}

<footer>

    <div class="container-fluid px-lg-5">

        <div class="row gy-4">

            <div class="col-lg-4">

                <h5>
                    <i class="bi bi-building me-2"
                       style="color:var(--secondary)"></i>

                    نقابة المهندسين
                </h5>

                <p class="small mt-3 lh-lg">

                    المنصة الرقمية الحديثة لخدمة أعضاء نقابة المهندسين
                    بمحافظة قنا وتقديم الخدمات بشكل إلكتروني سريع ومتطور.

                </p>

            </div>

            <div class="col-lg-4">

                <h6 class="mb-3">روابط سريعة</h6>

                <ul class="list-unstyled small lh-lg">

                    <li>
                        <a href="{{ route('news.index') }}">
                            الأخبار
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('committees.index') }}">
                            اللجان
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('trips.index') }}">
                            الرحلات
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('stadium.index') }}">
                            حجز الملعب
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('healthcare.index') }}">
                            الرعاية الصحية
                        </a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-4">

                <h6 class="mb-3">تواصل معنا</h6>

                <p class="small">
                    <i class="bi bi-telephone me-1"></i>
                    01019932826
                </p>

                <p class="small">
                    <i class="bi bi-envelope me-1"></i>
                    info@engineers-qena.com
                </p>

                <p class="small">
                    <i class="bi bi-geo-alt me-1"></i>
                    قنا - جمهورية مصر العربية
                </p>

            </div>

        </div>

        <hr style="border-color: rgba(255,255,255,.15)">

        <p class="text-center small mb-0">

            © {{ date('Y') }}
            نقابة المهندسين - قنا

            <br>

            جميع الحقوق محفوظة

        </p>

    </div>

</footer>

{{-- ================= FLOATING WHATSAPP ================= --}}

@php
    $whatsapp = \App\Models\Setting::where('key', 'contact_phone')->value('value') ?? '201019932826';
    $contact_phone = preg_replace('/[^0-9]/', '', $whatsapp);
    
    // ترميز الرسالة لضمان عمل الرابط بشكل صحيح مع المتصفحات
    $welcome_msg = urlencode("مرحبًا، لدي استفسار بخصوص خدمات نقابة المهندسين - قنا. أرجو الرد في أقرب وقت ممكن.");
@endphp

<a href="https://wa.me/{{ $contact_phone }}?text={{ $welcome_msg }}"
   target="_blank"
   class="floating-whatsapp">
    <i class="bi bi-whatsapp"></i>
</a>


{{-- ================= SCRIPTS ================= --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
window.addEventListener('scroll', function () {

    const nav = document.querySelector('.navbar');

    if(window.scrollY > 20){
        nav.classList.add('scrolled');
    }else{
        nav.classList.remove('scrolled');
    }

});
</script>

@stack('scripts')

</body>
</html>
```
