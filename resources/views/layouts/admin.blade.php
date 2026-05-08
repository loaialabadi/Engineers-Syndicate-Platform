<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - نقابة المهندسين</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #1a3a5c; --secondary: #c8a84b; --sidebar-width: 260px; }
        body { font-family: 'Cairo', sans-serif; background: #f0f2f5; }
        .sidebar {
            width: var(--sidebar-width); min-height: 100vh; position: fixed;
            top: 0; right: 0; background: var(--primary); z-index: 1000;
            display: flex; flex-direction: column;
        }
        .sidebar-brand { padding: 20px; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar-brand h6 { color: #fff; font-weight: 800; margin: 0; font-size: 1rem; }
        .sidebar-brand small { color: var(--secondary); }
        .sidebar-nav { padding: 15px 0; flex: 1; }
        .sidebar-nav .nav-section { padding: 8px 20px 4px; font-size: 0.7rem; color: rgba(255,255,255,.4); text-transform: uppercase; font-weight: 700; letter-spacing: 1px; }
        .sidebar-nav .nav-link {
            color: rgba(255,255,255,.75); padding: 10px 20px; border-radius: 0;
            font-weight: 600; font-size: .9rem; transition: all .2s;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active {
            color: #fff; background: rgba(255,255,255,.1); border-right: 3px solid var(--secondary);
        }
        .sidebar-nav .nav-link i { font-size: 1rem; color: var(--secondary); }
        .main-content { margin-right: var(--sidebar-width); padding: 0; min-height: 100vh; }
        .top-bar { background: #fff; padding: 12px 25px; border-bottom: 1px solid #e9ecef; display: flex; justify-content: space-between; align-items: center; }
        .page-content { padding: 25px; }
        .card { border: none; box-shadow: 0 1px 10px rgba(0,0,0,.07); border-radius: 10px; }
        .stat-card { border-radius: 12px; color: #fff; padding: 20px; }
        .table { font-size: .9rem; }
        .badge { font-size: .75rem; }
        @media (max-width: 768px) {
            .sidebar { width: 100%; min-height: auto; position: relative; }
            .main-content { margin-right: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <h6><i class="bi bi-building me-2"></i>نقابة المهندسين</h6>
        <small>لوحة التحكم الإدارية</small>
    </div>
    <nav class="sidebar-nav">
        <span class="nav-section">الرئيسية</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> لوحة التحكم
        </a>
        <span class="nav-section">إدارة المحتوى</span>
        <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> إدارة الأخبار
        </a>
        <a href="{{ route('admin.committees.index') }}" class="nav-link {{ request()->routeIs('admin.committees*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> اللجان
        </a>
    



            <a href="{{ route('admin.healthcare.dashboard') }}" class="nav-link {{ request()->routeIs('admin.healthcare*') ? 'active' : '' }}"> 
                <i class="bi bi-hospital"></i> الرعاية الصحية
            </a>
        <a href="{{ route('admin.trips.index') }}" class="nav-link {{ request()->routeIs('admin.trips*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt-fill"></i> الرحلات
        </a>


        <span class="nav-section">إدارة الحجوزات</span>
        <a href="{{ route('admin.stadium.bookings') }}" class="nav-link {{ request()->routeIs('admin.bookings.stadium*') ? 'active' : '' }}">
            <i class="bi bi-trophy-fill"></i> حجوزات الملعب
        </a>
        <a href="{{ route('admin.bookings.trips') }}" class="nav-link {{ request()->routeIs('admin.bookings.trips*') ? 'active' : '' }}">
            <i class="bi bi-suitcase-fill"></i> حجوزات الرحلات
        </a>
        <span class="nav-section">النظام</span>
        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="bi bi-globe"></i> الموقع العام
        </a>

        <a href="{{ route('admin.services.index') }}" class="nav-link" target="_blank">
            <i class="bi bi-globe"></i> خدمات النقابه
        </a>

        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> الإعدادات
        </a>

        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" style="cursor:pointer">
                <i class="bi bi-box-arrow-left"></i> تسجيل الخروج
            </button>
        </form>
    </nav>
</div>

<div class="main-content">
    <div class="top-bar">
        <h6 class="mb-0 fw-bold text-dark">@yield('page-title', 'لوحة التحكم')</h6>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</span>
        </div>
    </div>

    <div class="page-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>