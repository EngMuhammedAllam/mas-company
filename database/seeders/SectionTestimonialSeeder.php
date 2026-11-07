<?php

namespace Database\Seeders;

use App\Models\Testimonials\SectionTestimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_testimonials')->insert([
            'title' => 'آراء عملائنا الكرام',
            'description' => 'نفخر بثقة العملاء الذين استفادوا من خدماتنا في مجال التبريد والتكييف. إليكم بعض الآراء والتقييمات التي تعكس جودة عملنا واهتمامنا برضا العملاء.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
