@extends('layouts.public')

@section('title', 'تواصل معنا - نقابة المهندسين بقنا')

@section('content')
<div class="container py-5">
    <!-- عرض رسالة النجاح بعد الإرسال -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-5">
        <!-- نموذج التواصل -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
                <h3 class="fw-bold mb-4 text-primary">📩 أرسل لنا رسالة</h3>
                
                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- الاسم -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">الأسم *</label>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2" placeholder="أدخل اسمك الكامل" required>
                        </div>

                        <!-- الهاتف -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">الهاتف *</label>
                            <div class="input-group" dir="ltr">
                                <input type="text" name="phone" class="form-control bg-light border-0 py-2" placeholder="01xxxxxxxxx" required>
                                <span class="input-group-text bg-light border-0 text-muted">+20</span>
                            </div>
                        </div>

                        <!-- الأيميل -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">الأيميل *</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2" placeholder="example@mail.com" required>
                        </div>

                        <!-- نوع الطلب (الوصف) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">نوع الرسالة (الوصف)</label>
                            <select name="type" class="form-select bg-light border-0 py-2">
                                <option value="استفسار">أستفسار</option>
                                <option value="شكوى">شكوى</option>
                                <option value="طلب">طلب</option>
                            </select>
                        </div>

                        <!-- الموضوع -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">الموضوع *</label>
                            <input type="text" name="subject" class="form-control bg-light border-0 py-2" placeholder="موضوع الرسالة" required>
                        </div>

                        <!-- نص الرسالة -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">تفاصيل الرسالة *</label>
                            <textarea name="message" class="form-control bg-light border-0 py-2" rows="4" placeholder="اكتب تفاصيل طلبك هنا..." required></textarea>
                        </div>

                        <!-- المرفقات -->
                        <div class="col-12 mb-4">
                            <label class="form-label fw-bold">أرفق ملف (إن وجد)</label>
                            <input type="file" name="attachment" class="form-control bg-light border-0">
                            <div class="form-text small text-muted">الأنواع المسموحة: PDF, JPG, PNG (حد أقصى 2MB)</div>
                        </div>

                        <!-- زر الإرسال -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm rounded-pill fw-bold">
                                <i class="bi bi-send-fill me-2"></i> إرسال الطلب الآن
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- معلومات التواصل الجانبية -->
        <div class="col-lg-5">
            <div class="contact-info-card p-4 p-md-5 rounded-4 text-white shadow-lg h-100" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                <h4 class="fw-bold mb-4 border-bottom pb-3">بيانات التواصل</h4>
                
                <div class="d-flex mb-4">
                    <div class="icon-box me-3"><i class="bi bi-geo-alt-fill fs-4 text-warning"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">نقابة المهندسين بقنا</h6>
                        <p class="small mb-0">محافظة قنا، شارع النقابة الرئيسي.</p>
                    </div>
                </div>

<div class="mb-4">
    <h6 class="fw-bold mb-2">
        <i class="bi bi-telephone-fill me-2 text-warning"></i> أرقام الهواتف:
    </h6>
    <ul class="list-unstyled small ps-4">
        <li class="mb-2">
            📞 إدارة النقابة: 
            <span class="text-secondary">{{ $settings['phone_admin'] ?? 'غير محدد' }}</span>
        </li>
        <li class="mb-2">
            📱 العلاقات العامة: 
            <span class="text-secondary">{{ $settings['phone_public_relations'] ?? 'غير محدد' }}</span>
        </li>
        <li class="mb-2">
            👴 إدارة المعاشات: 
            <span class="text-secondary">{{ $settings['phone_pensions'] ?? 'غير محدد' }}</span>
        </li>
        <li class="mb-2">
            🏥 الرعاية الصحية: 
            <span class="text-secondary">{{ $settings['phone_health_care'] ?? 'غير محدد' }}</span>
        </li>
    </ul>
</div>


                <div class="mb-4">
                    <h6 class="fw-bold mb-2"><i class="bi bi-envelope-fill me-2 text-warning"></i> البريد الإلكتروني:</h6>
                    <a href="mailto:info@qanaeng.com" class="text-white text-decoration-none small ps-4">info@qanaeng.com</a>
                </div>

                <hr class="my-5 opacity-25">
                
                <div class="text-center">
                    <p class="small opacity-75 mb-1">© جميع الحقوق محفوظة لنقابة المهندسين - قنا 2024</p>
                    <p class="fw-bold small">مع تحيات لجنة العلاقات العامة و الإعلام</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 { border-radius: 1.2rem !important; }
    .contact-info-card { position: sticky; top: 20px; }
    .icon-box { min-width: 40px; }
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border: 1px solid #3b82f6 !important;
        box-shadow: none;
    }
</style>
@endsection
