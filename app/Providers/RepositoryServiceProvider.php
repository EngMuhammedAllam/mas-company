<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Interfaces\HeroRepositoryInterface::class, \App\Repositories\Eloquent\HeroRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\FeatureRepositoryInterface::class, \App\Repositories\Eloquent\FeatureRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ProjectCategoryRepositoryInterface::class, \App\Repositories\Eloquent\ProjectCategoryRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ServiceRepositoryInterface::class, \App\Repositories\Eloquent\ServiceRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\BlogRepositoryInterface::class, \App\Repositories\Eloquent\BlogRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\CounterRepositoryInterface::class, \App\Repositories\Eloquent\CounterRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ContactSettingRepositoryInterface::class, \App\Repositories\Eloquent\ContactSettingRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\AboutRepositoryInterface::class, \App\Repositories\Eloquent\AboutRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\CtaRepositoryInterface::class, \App\Repositories\Eloquent\CtaRepository::class);

        // Sections
        $this->app->bind(\App\Repositories\Interfaces\ServiceSectionRepositoryInterface::class, \App\Repositories\Eloquent\ServiceSectionRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ProjectSectionRepositoryInterface::class, \App\Repositories\Eloquent\ProjectSectionRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\SectionTestimonialRepositoryInterface::class, \App\Repositories\Eloquent\SectionTestimonialRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ProjectImageRepositoryInterface::class, \App\Repositories\Eloquent\ProjectImageRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ContactRepositoryInterface::class, \App\Repositories\Eloquent\ContactRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
