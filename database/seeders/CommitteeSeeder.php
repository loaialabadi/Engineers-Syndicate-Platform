<?php

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Seeder;

class CommitteeSeeder extends Seeder
{
    public function run(): void
    {
        $committees = [
            ['name' => 'لجنة الشؤون المهنية',     'description' => 'تختص بتطوير الممارسة المهنية للمهندسين ورفع كفاءتهم.',     'chairperson' => 'م. أحمد محمد', 'sort_order' => 1],
            ['name' => 'لجنة التدريب والتطوير',    'description' => 'تنظيم الدورات التدريبية وبرامج التطوير المهني المستمر.',     'chairperson' => 'م. سارة علي',   'sort_order' => 2],
            ['name' => 'لجنة الشؤون الاجتماعية',  'description' => 'رعاية شؤون الأعضاء الاجتماعية والترفيهية والرياضية.',       'chairperson' => 'م. محمد حسن',   'sort_order' => 3],
            ['name' => 'لجنة الإسكان والقروض',    'description' => 'تسهيل الحصول على قروض الإسكان وتمويل المشاريع الشخصية.',    'chairperson' => 'م. فاطمة عمر',  'sort_order' => 4],
            ['name' => 'لجنة الشباب والرياضة',    'description' => 'تنشيط الحركة الرياضية وتنمية قدرات الأعضاء الشباب.',        'chairperson' => 'م. خالد إبراهيم','sort_order' => 5],
            ['name' => 'لجنة تكنولوجيا المعلومات','description' => 'متابعة مستجدات التكنولوجيا ودعم التحول الرقمي في المنظومة.', 'chairperson' => 'م. نادية يوسف', 'sort_order' => 6],
        ];

        foreach ($committees as $c) {
            Committee::firstOrCreate(['name' => $c['name']], $c + ['is_active' => true]);
        }
    }
}