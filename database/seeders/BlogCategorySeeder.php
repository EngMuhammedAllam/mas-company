<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'تقنيات التبريد',
            'توفير الطاقة',
            'صيانة التكييف',
            'أنظمة ذكية',
            'مقالات عامة'
        ];

        foreach ($categories as $name) {
            BlogCategory::create([
                'name' => $name,
                'is_active' => true,
            ]);
        }
    }
}
