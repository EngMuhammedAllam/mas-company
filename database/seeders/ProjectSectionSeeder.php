<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_sections')->insert([
            'title' => 'أعمالنا ومشاريعنا في أنظمة التبريد والتكييف',
            'description' => 'نفخر بتنفيذ العديد من المشاريع الناجحة في مجال أنظمة التبريد والتكييف المركزية. اكتشف بعض أعمالنا البارزة التي تميزت بالجودة والكفاءة.',
            'is_active' => true,
        ]);
    }
}
