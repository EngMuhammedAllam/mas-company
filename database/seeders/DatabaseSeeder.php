<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Auth\Database\Seeders\AuthDatabaseSeeder;
use Database\Seeders\ProjectImageSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AuthDatabaseSeeder::class,
            HeroSectionSeeder::class,
            FeatureSectionSeeder::class,
            ProjectSectionSeeder::class,
            ProjectCategorySeeder::class,
            ProjectImageSeeder::class,
            ServiceSectionSeeder::class,
            ServiceSeeder::class,
            SectionTestimonialSeeder::class,
            TestimonialSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            AboutSeeder::class,
            CtaSeeder::class,
            ContactSettingSeeder::class,
            CounterSeeder::class,
            CoolingSystemDataSeeder::class,
        ]);
    }
}
