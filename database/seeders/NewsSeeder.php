<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@syndicate.gov.eg')->first();
        
        // تأكد من وجود الأدمن حتى لا يظهر خطأ
        if (!$admin) {
            $admin = User::factory()->create(['email' => 'admin@syndicate.gov.eg']);
        }

        $baseItems = [
            [
                'title'   => 'افتتاح المقر الجديد لنقابة المهندسين',
                'excerpt' => 'تم افتتاح المقر الجديد لنقابة المهندسين بحضور كبار المسؤولين.',
                'content' => '<p>في حفل بهيج حضره عدد كبير من المهندسين والمسؤولين...</p>',
            ],
            [
                'title'   => 'إطلاق برنامج التطوير المهني للمهندسين 2025',
                'excerpt' => 'النقابة تطلق برنامجاً شاملاً لتطوير المهارات المهنية للأعضاء.',
                'content' => '<p>أعلنت نقابة المهندسين عن إطلاق برنامج التطوير المهني للعام 2025...</p>',
            ],
            [
                'title'   => 'مبادرة الإسكان لأعضاء النقابة',
                'excerpt' => 'فرصة ذهبية للأعضاء للحصول على وحدات سكنية بأسعار مميزة.',
                'content' => '<p>في إطار خدمة أعضاء النقابة، تعلن الهيئة عن فتح باب التسجيل...</p>',
            ],
        ];

        // تكرار البيانات لإنشاء 50 خبر
        for ($i = 1; $i <= 50; $i++) {
            $item = $baseItems[array_rand($baseItems)]; // اختيار خبر عشوائي من القائمة أعلاه
            
            News::create([
                'title'        => $item['title'] . ' - نسخة رقم ' . $i,
                'slug'         => Str::slug($item['title'], '-', null) . '-' . Str::random(5) . '-' . $i,
                'excerpt'      => $item['excerpt'],
                'content'      => $item['content'],
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 100)), // تواريخ عشوائية في آخر 100 يوم
                'created_by'   => $admin->id,
                'image'        => 'news/default.jpg', // مسار افتراضي للصورة
            ]);
        }
    }
}
