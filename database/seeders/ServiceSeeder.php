<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // القيد
            ['title' => 'القيد لأول مرة', 'category' => 'القيد', 'sort_order' => 1],
            ['title' => 'تجديد الاشتراك', 'category' => 'القيد', 'sort_order' => 2],

            // منح وإعانات
            ['title' => 'منح و إعانات', 'category' => 'المنح', 'sort_order' => 3],
            ['title' => 'الإعانة الصحية', 'category' => 'المنح', 'sort_order' => 4],
            ['title' => 'منحة الزواج لإبنة المهندس المتوفي', 'category' => 'المنح', 'sort_order' => 5],
            ['title' => 'منحة المجندين', 'category' => 'المنح', 'sort_order' => 6],
            ['title' => 'مصاريف الجنازة للمهندس المتوفي', 'category' => 'المنح', 'sort_order' => 7],

            // مشروع الرعاية الصحية
            ['title' => 'مشروع الرعاية الصحية', 'category' => 'الرعاية الصحية', 'sort_order' => 8],
            ['title' => 'الأوراق المطلوبة للإشتراك و التجديد', 'category' => 'الرعاية الصحية', 'sort_order' => 9],
            ['title' => 'رسوم الاشتراك و التجديد', 'category' => 'الرعاية الصحية', 'sort_order' => 10],
            ['title' => 'دليل مشروع الرعاية الصحية', 'category' => 'الرعاية الصحية', 'sort_order' => 11],
            ['title' => 'خدمة الواتساب للرعاية الصحية', 'category' => 'الرعاية الصحية', 'sort_order' => 12, 'has_whatsapp' => true, 'whatsapp_number' => '01000000000'],

            // المعاشات
            ['title' => 'المعاشات', 'category' => 'المعاشات', 'sort_order' => 13],
            ['title' => 'معاش سن الستين', 'category' => 'المعاشات', 'sort_order' => 14],
            ['title' => 'معاش أقل من 60 سنة', 'category' => 'المعاشات', 'sort_order' => 15],
            ['title' => 'مشروع معاش الأسرة', 'category' => 'المعاشات', 'sort_order' => 16],
            ['title' => 'معاش العجز الصحي', 'category' => 'المعاشات', 'sort_order' => 17],

            // شهادات واعتمادات
            ['title' => 'شهادات و إعتمادات', 'category' => 'الشهادات', 'sort_order' => 18],
            ['title' => 'شهادة عضوية', 'category' => 'الشهادات', 'sort_order' => 19],
            ['title' => 'ختم إستمارة الرقم القومي', 'category' => 'الشهادات', 'sort_order' => 20],
        ];

        foreach ($services as $service) {
            Service::create(array_merge([
                'description' => 'وصف تجريبي لخدمة ' . $service['title'],
                'content' => 'محتوى تفصيلي لخدمة ' . $service['title'],
                'image' => 'images/default.png', // مسار افتراضي للصورة
                'is_active' => true,
                'has_whatsapp' => false,
            ], $service));
        }
    }
}
