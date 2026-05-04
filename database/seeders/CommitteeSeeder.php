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
            ['name' => 'لجنة العلاقات العامة',    'description' => 'تعزيز التواصل مع وسائل الإعلام والجمهور وترويج أنشطة النقابة.', 'chairperson' => 'م. علي محمود',   'sort_order' => 7],
            ['name' => 'لجنة الشؤون القانونية',     'description' => 'تقديم الاستشارات القانونية والدفاع عن حقوق الأعضاء.',        'chairperson' => 'م. ريم عبد الله','sort_order' => 8],
            ['name' => 'لجنة البيئة والاستدامة',     'description' => 'تعزيز الوعي البيئي وتشجيع الممارسات المستدامة بين الأعضاء.',  'chairperson' => 'م. سامي مصطفى',  'sort_order' => 9],
            ['name' => 'لجنة البحث العلمي والابتكار','description' => 'دعم البحث العلمي وتشجيع الابتكار في مجال الهندسة.',          'chairperson' => 'م. ليلى أحمد',    'sort_order' => 10],        
            ['name' => 'لجنة التعليم الهندسي',     'description' => 'التعاون مع الجامعات والمؤسسات التعليمية لتحسين جودة التعليم الهندسي.', 'chairperson' => 'م. يوسف علي',    'sort_order' => 11],
            ['name' => 'لجنة الصحة والسلامة المهنية', 'description' => 'تعزيز ثقافة السلامة المهنية وحماية صحة الأعضاء في مواقع العمل.', 'chairperson' => 'م. هالة عبد الرحمن', 'sort_order' => 12],    
            ['name' => 'لجنة الشؤون الدولية',     'description' => 'تعزيز العلاقات الدولية والتعاون مع النقابات الهندسية العالمية.', 'chairperson' => 'م. عمرو سعيد',    'sort_order' => 13],
            ['name' => 'لجنة الشؤون المالية',     'description' => 'إدارة الموارد المالية للنقابة وضمان الشفافية في التعاملات المالية.', 'chairperson' => 'م. منى عبد العزيز',    'sort_order' => 14],  
        ];

        foreach ($committees as $c) {
            Committee::firstOrCreate(['name' => $c['name']], $c + ['is_active' => true]);
        }
    }
}