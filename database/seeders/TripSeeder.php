<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        $trips = [
            [
                'title'       => 'رحلة الساحل الشمالي – الصيف 2025',
                'description' => '<p>استمتع بأجواء الصيف الرائعة على شواطئ الساحل الشمالي. الرحلة تشمل الإقامة والمواصلات والأنشطة الترفيهية.</p>',
                'destination' => 'الساحل الشمالي',
                'trip_date'   => now()->addMonths(2)->toDateString(),
                'return_date' => now()->addMonths(2)->addDays(4)->toDateString(),
                'price'       => 1500,
                'max_seats'   => 40,
                'is_active'   => true,
            ],
            [
                'title'       => 'رحلة الأقصر والأسوان التراثية',
                'description' => '<p>جولة حضارية في ربوع صعيد مصر لاستكشاف الآثار الفرعونية الخالدة. الرحلة تشمل باخرة نيلية فاخرة.</p>',
                'destination' => 'الأقصر – أسوان',
                'trip_date'   => now()->addMonths(3)->toDateString(),
                'return_date' => now()->addMonths(3)->addDays(5)->toDateString(),
                'price'       => 2200,
                'max_seats'   => 30,
                'is_active'   => true,
            ],
            [
                'title'       => 'رحلة شرم الشيخ العائلية',
                'description' => '<p>رحلة عائلية رائعة إلى لؤلؤة البحر الأحمر، تشمل الغطس ورياضات المياه والأنشطة العائلية.</p>',
                'destination' => 'شرم الشيخ',
                'trip_date'   => now()->addMonths(4)->toDateString(),
                'return_date' => now()->addMonths(4)->addDays(3)->toDateString(),
                'price'       => 1800,
                'max_seats'   => 50,
                'is_active'   => true,
            ],
        ];

        foreach ($trips as $t) {
            Trip::firstOrCreate(
                ['title' => $t['title']],
                array_merge($t, ['slug' => Str::slug($t['title']) . '-' . Str::random(5)])
            );
        }
    }
}