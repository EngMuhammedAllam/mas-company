<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_images')->insert([
            [
                'title' => 'غرف تبريد المستشفيات',
                'decription' => 'أنظمة تبريد متكاملة للمستشفيات',
                'image' => 'project1.jpeg',
                'is_active' => true,
                'sort_order' => 1,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'تكييف مراكز التسوق',
                'decription' => 'أنظمة تكييف مركزية للمولات التجارية',
                'image' => 'project2.jpeg',
                'is_active' => true,
                'sort_order' => 1,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'تبريد المستودعات',
                'decription' => 'أنظمة تبريد للمستودعات الغذائية',
                'image' => 'project3.jpg',
                'is_active' => true,
                'sort_order' => 1,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'صيانة الأنظمة المركزية',
                'decription' => 'برامج صيانة وقائية للأنظمة',
                'image' => 'project4.jpg',
                'is_active' => true,
                'sort_order' => 1,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
