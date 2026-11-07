<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\Service\Service;
use App\Models\Service\ServiceSection;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert([
            [
                'service_section_id' => ServiceSection::first()->id,
                'title' => 'تركيب وصيانة أنظمة التبريد والتكييف',
                'description' => 'نقدم خدمات تركيب وصيانة شاملة لأنظمة التبريد والتكييف، مع فريق متخصص يضمن أداءً ممتازًا وكفاءة عالية لتلبية احتياجات عملائنا.',
                'icon' => 'services/icon-04.svg',
                'is_active' => true,
            ],
            [
                'service_section_id' => ServiceSection::first()->id,
                'title' => 'تصميم وتنفيذ غرف التبريد الصناعية',
                'description' => 'نقوم بتصميم وتنفيذ غرف تبريد صناعية متقدمة تلبي متطلبات التخزين والتبريد الخاصة بعملائنا، مع التركيز على الجودة والكفاءة في الأداء.',
                'icon' => 'services/icon-05.svg',
                'is_active' => true,
            ],
            [
                'service_section_id' => ServiceSection::first()->id,
                'title' => 'أنظمة التبريد المركزية للمباني التجارية',
                'description' => 'نوفر حلول تبريد مركزية متكاملة للمباني التجارية، تضمن توزيعًا فعالًا للهواء المبرد وتحقيق راحة مثلى للمستخدمين.',
                'icon' => 'services/icon-07.svg',
                'is_active' => true,
            ],
            [
                'service_section_id' => ServiceSection::first()->id,
                'title' => 'استشارات وتحليل أنظمة التبريد والتكييف',
                'description' => 'نقدم خدمات استشارية وتحليلية متخصصة لأنظمة التبريد والتكييف، لمساعدة عملائنا في تحسين الأداء وتقليل التكاليف التشغيلية.',
                'icon' => 'services/icon-07.svg',
                'is_active' => true,
            ],
            [
                'service_section_id' => ServiceSection::first()->id,
                'title' => 'توريد وتركيب معدات التبريد والتكييف',
                'description' => 'نقوم بتوريد وتركيب أحدث معدات التبريد والتكييف من أفضل العلامات التجارية، لضمان جودة عالية وأداء موثوق به لعملائنا.',
                'icon' => 'services/icon-05.svg',
                'is_active' => true,
            ],
            [
                'service_section_id' => ServiceSection::first()->id,
                'title' => 'خدمات الطوارئ والدعم الفني لأنظمة التبريد',
                'description' => 'نوفر خدمات طوارئ ودعم فني متواصل لأنظمة التبريد والتكييف، لضمان استمرارية العمل وتقليل فترات التوقف غير المخطط لها.',
                'icon' => 'services/icon-06.svg',
                'is_active' => true,
            ],

        ]);
    }
}
