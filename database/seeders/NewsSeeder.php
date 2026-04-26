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

        $items = [
            [
                'title'   => 'افتتاح المقر الجديد لنقابة المهندسين',
                'excerpt' => 'تم افتتاح المقر الجديد لنقابة المهندسين بحضور كبار المسؤولين.',
                'content' => '<p>في حفل بهيج حضره عدد كبير من المهندسين والمسؤولين، تم افتتاح المقر الجديد لنقابة المهندسين الذي يضم أحدث التجهيزات والمرافق الخدمية.</p><p>يتضمن المقر الجديد قاعات للتدريب ومركزاً للخدمات الإلكترونية وناديًا اجتماعيًا متكاملًا.</p>',
            ],
            [
                'title'   => 'إطلاق برنامج التطوير المهني للمهندسين 2025',
                'excerpt' => 'النقابة تطلق برنامجاً شاملاً لتطوير المهارات المهنية للأعضاء.',
                'content' => '<p>أعلنت نقابة المهندسين عن إطلاق برنامج التطوير المهني للعام 2025، والذي يشمل أكثر من 50 دورة تدريبية متخصصة في مجالات الهندسة المختلفة.</p>',
            ],
            [
                'title'   => 'مبادرة الإسكان لأعضاء النقابة – التسجيل متاح الآن',
                'excerpt' => 'فرصة ذهبية للأعضاء للحصول على وحدات سكنية بأسعار مميزة.',
                'content' => '<p>في إطار خدمة أعضاء النقابة، تعلن الهيئة عن فتح باب التسجيل في مبادرة الإسكان الاجتماعي المخصصة للمهندسين بأسعار تنافسية وتسهيلات في السداد.</p>',
            ],
        ];

        foreach ($items as $item) {
            News::firstOrCreate(
                ['title' => $item['title']],
                array_merge($item, [
                    'slug'         => Str::slug($item['title']) . '-' . Str::random(5),
                    'is_published' => true,
                    'published_at' => now()->subDays(rand(1, 30)),
                    'created_by'   => $admin->id,
                ])
            );
        }
    }
}