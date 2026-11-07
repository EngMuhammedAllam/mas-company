<?php

namespace Database\Seeders;

use App\Models\Feature\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeatureSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::insert([
            [
                'title' => 'كفاءة الطاقة العالية',
                'image' => 'features/icon-05.svg',
                'description' => 'أنظمة تبريد وتكييف موفرة للطاقة تخفض تكاليف التشغيل بنسبة تصل إلى 40%'
            ],
            [
                'title' => 'الصيانة الدورية',
                'image' => 'features/icon-04.svg',
                'description' => 'برامج صيانة وقائية منتظمة تضمن أداءً مستقراً وعمراً أطول للأنظمة'
            ],
            [
                'title' => 'حلول مخصصة',
                'image' => 'features/icon-06.svg',
                'description' => 'تصميم أنظمة تبريد وتكييف مركزية تلبي الاحتياجات الخاصة لكل عميل'
            ]
        ]);
    }
}
