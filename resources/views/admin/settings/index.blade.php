@extends('layouts.admin')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">⚙️ الإعدادات العامة للنظام</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf

        <!-- بيانات الموقع الأساسية -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                بيانات الموقع العامة
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">اسم الموقع</label>
                        <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">رقم التواصل الأساسي</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">رقم الواتساب الرئيسي</label>
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['whatsapp_number'] ?? '' }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">البريد الإلكتروني الرسمي</label>
                        <input type="email" name="site_email" class="form-control" value="{{ $settings['site_email'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- بيانات التواصل التفصيلية (التي طلبتها) -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
                بيانات التواصل الخاصة بالنقابة (صفحة اتصل بنا)
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">عنوان النقابة</label>
                        <input type="text" name="address" class="form-control" value="{{ $settings['address'] ?? 'محافظة قنا، شارع النقابة الرئيسي.' }}">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">📞 هاتف إدارة النقابة</label>
                        <input type="text" name="phone_admin" class="form-control" value="{{ $settings['phone_admin'] ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">📱 هاتف العلاقات العامة</label>
                        <input type="text" name="phone_public_relations" class="form-control" value="{{ $settings['phone_public_relations'] ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">👴 هاتف إدارة المعاشات</label>
                        <input type="text" name="phone_pensions" class="form-control" value="{{ $settings['phone_pensions'] ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">🏥 هاتف الرعاية الصحية</label>
                        <input type="text" name="phone_health_care" class="form-control" value="{{ $settings['phone_health_care'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- إعدادات الملعب -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-success text-white fw-bold">
                إعدادات الملعب
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">سعر الساعة (ج.م)</label>
                    <input type="number" name="stadium_price" class="form-control" value="{{ $settings['stadium_price'] ?? '' }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">وقت الفتح</label>
                        <input type="time" name="stadium_open_time" class="form-control" value="{{ $settings['stadium_open_time'] ?? '09:00' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">وقت الغلق</label>
                        <input type="time" name="stadium_close_time" class="form-control" value="{{ $settings['stadium_close_time'] ?? '02:00' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- إعدادات الرحلات -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-info text-white fw-bold">
                إعدادات الرحلات
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">واتساب الرحلات</label>
                    <input type="text" name="trips_whatsapp" class="form-control" value="{{ $settings['trips_whatsapp'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">ملاحظات الرحلات</label>
                    <textarea name="trips_notes" class="form-control" rows="3">{{ $settings['trips_notes'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- زر الحفظ العائم -->
        <div class="card card-body shadow-sm sticky-bottom border-0">
            <button class="btn btn-primary btn-lg fw-bold shadow">
                <i class="bi bi-save me-2"></i> حفظ كافة الإعدادات
            </button>
        </div>

    </form>
</div>

<style>
    .card { border-radius: 12px; }
    .card-header { border-radius: 12px 12px 0 0 !important; }
    .sticky-bottom { bottom: 20px; z-index: 1020; }
</style>

@endsection
