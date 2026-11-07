<?php

namespace Database\Seeders;

use App\Models\Testimonials\SectionTestimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'أحمد محمد',
                'position' => 'مدير مشروع',
                'message' => 'خدمة ممتازة وفريق محترف. أنصح بشدة بالتعامل معهم.',
                'active' => true,
                'section_testimonial_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سارة علي',
                'position' => 'مهندسة مبيعات',
                'message' => 'كانت تجربتي رائعة من البداية إلى النهاية. شكراً لكم على الدعم المستمر.',
                'active' => true,
                'section_testimonial_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'خالد حسن',
                'position' => 'مالك شركة',
                'message' => 'الجودة والاحترافية في العمل كانت واضحة جداً. سأعود بالتأكيد لاستخدام خدماتهم مرة أخرى.',
                'active' => true,
                'section_testimonial_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محمد علي',
                'position' => 'مدير مشروع',
                'message' => 'كانت تجربتي رائعة من البداية إلى النهاية. شكراً لكم على الدعم المستمر.',
                'active' => true,
                'section_testimonial_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سارة علي',
                'position' => 'مهندسة مبيعات',
                'message' => 'كانت تجربتي رائعة من البداية إلى النهاية. شكراً لكم على الدعم المستمر.',
                'active' => true,
                'section_testimonial_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
