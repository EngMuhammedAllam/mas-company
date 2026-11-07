<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\Service\ServiceSection;
use Illuminate\Database\Seeder;

class ServiceSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceSection::create([
            'title' => 'حلول متكاملة لأنظمة التبريد والتكييف المركزية',
            'description' => 'نقدم أحدث الحلول المتكاملة في مجال غرف التبريد والتكييف والأنظمة المركزية، مصممة لتلبي احتياجاتك بدقة عالية وكفاءة استثنائية. نضمن لك بيئات مبردة ومكيفة بمعايير الجودة العالمية لقطاعات الصناعة والتجارة والخدمات.',
            'is_active' => true,
        ]);
    }
}
