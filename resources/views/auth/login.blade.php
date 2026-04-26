<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول - نقابة المهندسين</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background: linear-gradient(135deg, #1a3a5c, #2d5a8e); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,.3); }
        .login-header { background: linear-gradient(135deg, #1a3a5c, #2d5a8e); color: #fff; padding: 30px; border-radius: 16px 16px 0 0; text-align: center; }
        .login-header h4 { font-weight: 800; }
        .form-control:focus { border-color: #1a3a5c; box-shadow: 0 0 0 0.2rem rgba(26,58,92,.25); }
        .btn-login { background: #1a3a5c; border: none; font-weight: 700; padding: 12px; font-size: 1rem; }
        .btn-login:hover { background: #0f2540; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="login-header">
                    <div style="font-size:3rem; color:#c8a84b;"><i class="bi bi-building"></i></div>
                    <h4 class="mt-2">نقابة المهندسين</h4>
                    <p class="mb-0 opacity-75 small">تسجيل دخول لوحة التحكم</p>
                </div>
                <div class="card-body p-4">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
                    @if($errors->any())
                        <div class="alert alert-danger small"><i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}</div>
                    @endif
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="example@syndicate.gov.eg" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">كلمة المرور</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label small" for="remember">تذكرني</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-login btn-primary w-100 text-white">
                            <i class="bi bi-box-arrow-in-right me-2"></i>تسجيل الدخول
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-center text-white-50 small mt-3">© {{ date('Y') }} نقابة المهندسين</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>