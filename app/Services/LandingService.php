<?php

namespace App\Services;

use App\Repositories\Interfaces\HeroRepositoryInterface;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Repositories\Interfaces\ProjectCategoryRepositoryInterface;
use App\Repositories\Interfaces\ProjectSectionRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\ServiceSectionRepositoryInterface;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\CounterRepositoryInterface;
use App\Repositories\Interfaces\ContactSettingRepositoryInterface;
use App\Repositories\Interfaces\AboutRepositoryInterface;
use App\Repositories\Interfaces\CtaRepositoryInterface;
use App\Repositories\Interfaces\SectionTestimonialRepositoryInterface;

class LandingService
{
    protected $heroRepo;
    protected $featureRepo;
    protected $categoryRepo;
    protected $projectSectionRepo;
    protected $serviceRepo;
    protected $serviceSectionRepo;
    protected $blogRepo;
    protected $counterRepo;
    protected $contactRepo;
    protected $aboutRepo;
    protected $ctaRepo;
    protected $testimonialSectionRepo;

    public function __construct(
        HeroRepositoryInterface $heroRepo,
        FeatureRepositoryInterface $featureRepo,
        ProjectCategoryRepositoryInterface $categoryRepo,
        ProjectSectionRepositoryInterface $projectSectionRepo,
        ServiceRepositoryInterface $serviceRepo,
        ServiceSectionRepositoryInterface $serviceSectionRepo,
        BlogRepositoryInterface $blogRepo,
        CounterRepositoryInterface $counterRepo,
        ContactSettingRepositoryInterface $contactRepo,
        AboutRepositoryInterface $aboutRepo,
        CtaRepositoryInterface $ctaRepo,
        SectionTestimonialRepositoryInterface $testimonialSectionRepo
    ) {
        $this->heroRepo = $heroRepo;
        $this->featureRepo = $featureRepo;
        $this->categoryRepo = $categoryRepo;
        $this->projectSectionRepo = $projectSectionRepo;
        $this->serviceRepo = $serviceRepo;
        $this->serviceSectionRepo = $serviceSectionRepo;
        $this->blogRepo = $blogRepo;
        $this->counterRepo = $counterRepo;
        $this->contactRepo = $contactRepo;
        $this->aboutRepo = $aboutRepo;
        $this->ctaRepo = $ctaRepo;
        $this->testimonialSectionRepo = $testimonialSectionRepo;
    }

    public function getLandingData()
    {
        $heroSection = $this->heroRepo->first();
        $counters = $this->counterRepo->get()->take(4);
        $contactSetting = $this->contactRepo->first();
        $aboutSection = $this->aboutRepo->getWithPoints();
        $ctaSection = $this->ctaRepo->first();

        $features = $this->featureRepo->get();
        $projectSection = $this->projectSectionRepo->first();
        $projectcategories = $this->categoryRepo->get()->load('images')->where('active', 1);

        $serviceSection = $this->serviceSectionRepo->first();
        $services = $this->serviceRepo->get()->where('is_active', 1)->sortBy('sort_order');

        $testimonialSection = $this->testimonialSectionRepo->first();
        $testimonials = $testimonialSection && $testimonialSection->is_active
            ? $testimonialSection->testimonials()->active()->orderBy('sort_order', 'asc')->get()
            : collect([]);

        $posts = $this->blogRepo->get()
            ->where('is_active', true)
            ->where('published_at', '<=', now()->toDateString())
            ->sortByDesc('published_at')
            ->take(3);

        return compact(
            'heroSection',
            'counters',
            'contactSetting',
            'aboutSection',
            'ctaSection',
            'features',
            'serviceSection',
            'projectSection',
            'projectcategories',
            'services',
            'testimonialSection',
            'testimonials',
            'posts'
        );
    }
}
