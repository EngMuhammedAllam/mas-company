<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_categories')->insert([
            ['name' => 'غرف التبريد', 'slug' => 'cooling', 'is_active' => true],
            ['name' => 'أنظمة التكييف', 'slug' => 'ac', 'is_active' => true],
            ['name' => 'الصيانة والتشغيل', 'slug' => 'maintenance', 'is_active' => true],
        ]);
    }
}
