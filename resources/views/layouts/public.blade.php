<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'نقابة المهندسين') - المنصة الرقمية</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a3a5c;
            --secondary: #c8a84b;
            --light-bg: #f5f7fa;
        }
        body { font-family: 'Cairo', sans-serif; background: var(--light-bg); }
        .navbar-brand { font-weight: 800; font-size: 1.3rem; }
        .navbar { background: var(--primary) !important; }
        .navbar .nav-link { color: rgba(255,255,255,.85) !important; font-weight: 600; }
        .navbar .nav-link:hover { color: var(--secondary) !important; }
        .hero-section { background: linear-gradient(135deg, var(--primary) 0%, #2d5a8e 100%); color: #fff; padding: 80px 0; }
        .section-title { font-weight: 800; color: var(--primary); position: relative; margin-bottom: 2rem; }
        .section-title::after { content:''; display:block; width:60px; height:4px; background: var(--secondary); margin-top: 8px; }
        .card { border: none; box-shadow: 0 2px 15px rgba(0,0,0,.07); border-radius: 12px; transition: transform .2s, box-shadow .2s; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,.12); }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: #0f2540; border-color: #0f2540; }
        .btn-warning { background: var(--secondary); border-color: var(--secondary); color: #fff; }
        footer { background: var(--primary); color: rgba(255,255,255,.8); padding: 40px 0 20px; }
        footer a { color: var(--secondary); text-decoration: none; }
        .news-img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px 8px 0 0; }
        .badge-published { background: #198754; }
        .whatsapp-btn { background: #25d366; border-color: #25d366; color: #fff; font-weight: 700; }
        .whatsapp-btn:hover { background: #1da851; border-color: #1da851; color: #fff; }
        

        input[type="checkbox"]:checked + label {
    background: #198754 !important;
    color: #fff !important;
}
    </style>
    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('home') }}">
            <i class="bi bi-building me-1" style="color: var(--secondary)"></i>
            نقابة المهندسين
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i>الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}"><i class="bi bi-newspaper me-1"></i>الأخبار</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('committees.index') }}"><i class="bi bi-people me-1"></i>اللجان</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('healthcare.index') }}"><i class="bi bi-heart-pulse me-1"></i>الرعاية الصحية</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('trips.index') }}"><i class="bi bi-geo-alt me-1"></i>الرحلات</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('stadium.index') }}"><i class="bi bi-trophy me-1"></i>حجز الملعب</a></li>
            </ul>
            <div class="ms-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-warning fw-bold">
                            <i class="bi bi-speedometer2 me-1"></i>لوحة التحكم
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light fw-bold">
                        <i class="bi bi-box-arrow-in-right me-1"></i>تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-0 rounded-0 text-center" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0 text-center" role="alert">
    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Main Content --}}
@yield('content')

{{-- Footer --}}
<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold text-white"><i class="bi bi-building me-2" style="color:var(--secondary)"></i>نقابة المهندسين</h5>
                <p class="small">المنصة الرقمية لخدمة أعضاء نقابة المهندسين وتسهيل التواصل والحصول على الخدمات.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold text-white">روابط سريعة</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('news.index') }}">الأخبار</a></li>
                    <li><a href="{{ route('committees.index') }}">اللجان</a></li>
                    <li><a href="{{ route('trips.index') }}">الرحلات</a></li>
                    <li><a href="{{ route('stadium.index') }}">حجز الملعب</a></li>
                    <li>
<a href="{{ route('healthcare.index') }}">الرعاية الصحية</a>

</li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold text-white">تواصل معنا</h6>
                <p class="small"><i class="bi bi-telephone me-1"></i> 02-XXXXXXXX</p>
                <p class="small"><i class="bi bi-envelope me-1"></i> info@syndicate.gov.eg</p>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,.2)">
        <p class="text-center small mb-0">© {{ date('Y') }} نقابة المهندسين. جميع الحقوق محفوظة.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>