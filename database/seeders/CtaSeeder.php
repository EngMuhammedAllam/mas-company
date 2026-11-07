<?php

namespace Database\Seeders;

use App\Models\Cta\CtaSection;
use Illuminate\Database\Seeder;

class CtaSeeder extends Seeder
{
    public function run(): void
    {
        CtaSection::create([
            'title' => 'انضم إلى أكثر من 1000 عميل يثقون بخدماتنا في غرف التبريد والتجميد وأنظمة التكييف.',
            'description' => 'نقدم حلول متكاملة في تصميم وتنفيذ غرف التبريد والتجميد وأنظمة التكييف المركزي للمصانع، المخازن، والمشروعات التجارية بجودة وكفاءة عالية.',
        ]);
    }
}
