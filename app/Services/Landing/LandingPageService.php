<?php

namespace App\Services\Landing;

use App\Models\Blog\BlogPost;
use App\Models\Client\Client;
use App\Models\Cta\CtaSection;
use App\Models\Counter\Counter;
use App\Models\Feature\Feature;
use App\Models\Blog\BlogSection;
use App\Models\Hero\HeroSection;
use App\Models\About\AboutSection;
use App\Models\Setting\SeoSetting;
use Illuminate\Support\Collection;
use App\Models\Service\ServiceSection;
use App\Models\Setting\ContactSetting;
use App\Models\Projects\ProjectSection;
use App\Models\Projects\ProjectCategory;
use App\Models\Testimonials\SectionTestimonial;


class LandingPageService
{
    public function getLandingData(): array
    {
        // Cache static/semi-static data for 1 hour
        $seo = cache()->remember('seo_settings', 120, fn() => SeoSetting::first());
        $contactSetting = cache()->remember('contact_settings', 60, fn() => ContactSetting::first());
        $heroSection = HeroSection::first();
        $aboutSection = AboutSection::with('points')->first();
        $ctaSection = cache()->remember('cta_section', 60, fn() => CtaSection::first());
        $blogSection = cache()->remember('blog_section', 60, fn() => BlogSection::first());

        // Frequently changing data - cache for 10 minutes
        $counters = cache()->remember('landing_counters', 600, fn() => Counter::take(4)->get());
        $clients = cache()->remember('landing_clients', 600, fn() => Client::latest()->get());
        $features = cache()->remember('landing_features', 3600, fn() => Feature::get());

        // Service data - cache for 1 hour
        $services = cache()->remember('landing_services', 3600, function () {
            $serviceSection = ServiceSection::active();
            return $serviceSection ? $serviceSection->services()->active()->ordered()->get() : collect([]);
        });
        $serviceSection = cache()->remember('landing_service_section', 3600, fn() => ServiceSection::active());

        // Project data - cache for 1 hour
        $projectSection = cache()->remember('landing_project_section', 3600, fn() => ProjectSection::first());
        $projectcategories = cache()->remember('landing_project_categories', 3600, fn() => ProjectCategory::with('images')->get());

        // Testimonials - cache for 1 hour
        $testimonials = cache()->remember('landing_testimonials', 3600, function () {
            $testimonialSection = SectionTestimonial::where('is_active', 1)->first();
            return $testimonialSection
                ? $testimonialSection->testimonials()->active()->orderBy('sort_order', 'asc')->get()
                : collect([]);
        });
        $testimonialSection = cache()->remember('landing_testimonial_section', 3600, fn() => SectionTestimonial::where('is_active', 1)->first());

        // Blog posts - cache for 30 minutes
        $posts = cache()->remember('homepage_blog_posts', 1800, function () {
            return BlogPost::with('category')
                ->active()
                ->published()
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        });

        return compact(
            'seo',
            'contactSetting',
            'heroSection',
            'aboutSection',
            'ctaSection',
            'blogSection',
            'counters',
            'clients',
            'features',
            'services',
            'serviceSection',
            'projectSection',
            'projectcategories',
            'testimonials',
            'testimonialSection',
            'posts'
        );
    }
}
