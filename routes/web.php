<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\Main\DashboardController;
use App\Http\Controllers\Dashboard\Feature\FeatureController;
use App\Http\Controllers\Dashboard\Hero\HeroSectionController;
use App\Http\Controllers\Dashboard\Service\ServiceController;
use App\Http\Controllers\Dashboard\Projects\ProjectController;
use App\Http\Controllers\Dashboard\Projects\ProjectCategoryController;
use App\Http\Controllers\Dashboard\Projects\ProjectImageController;
use App\Http\Controllers\Dashboard\Projects\ProjectSectionController;
use App\Http\Controllers\Dashboard\Service\ServiceSectionController;
use App\Http\Controllers\Dashboard\Testimonial\TestimonialController;
use App\Http\Controllers\Dashboard\Testimonial\SectionTestimonialController;
use App\Http\Controllers\Dashboard\Blog\BlogPostController;
use App\Http\Controllers\Dashboard\Blog\BlogSectionController;
use App\Http\Controllers\Dashboard\SeoSettingController;
use App\Http\Controllers\Dashboard\CounterController;
use App\Http\Controllers\Dashboard\Setting\ContactSettingController;
use App\Http\Controllers\Dashboard\AboutSectionController;
use App\Http\Controllers\Dashboard\CtaSectionController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Landing\SitemapController;
use App\Http\Controllers\Landing\RobotsTxtController;

//  ========================================== Default Redirect ==========================================

Route::get('/', [LandingController::class, 'masCool'])->name('landing');
Route::get('/mas-cool-assets/{filename}', function (string $filename) {
    abort_unless(preg_match('/^[a-z0-9-]+\.png$/', $filename) === 1, 404);

    $path = resource_path('images/mas-cool/'.$filename);
    abort_unless(is_file($path), 404);

    return response()->file($path, [
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('filename', '[a-z0-9-]+\.png')->name('mas-cool.asset');
Route::get('/blog/{id}', [LandingController::class, 'showSingleBlog'])->name('blog.show');
Route::get('/blog/category/{id}', [LandingController::class, 'showBlogCategory'])->name('blog.category');
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');
Route::get('/robots.txt', [RobotsTxtController::class, 'index']);
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// ############################## [[== Admin ==]] Routes ################################### //
Route::group(['middleware' => ['check_auth']], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    // ############################ [Hero] Section Route ############################
    Route::get('/hero/edit', [HeroSectionController::class, 'index'])->name('admin.hero.edite');
    Route::post('/hero/update', [HeroSectionController::class, 'update'])->name('admin.hero.update');

    // ############################ [Features] Section Route ############################
    Route::get('features', [FeatureController::class, 'index'])->name('features.index');
    Route::get('features/create', [FeatureController::class, 'create'])->name('features.create');
    Route::post('features', [FeatureController::class, 'store'])->name('features.store');
    Route::get('features-edit/{id}', [FeatureController::class, 'edit'])->name('features.edit');
    Route::put('features/{id}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('features/{id}', [FeatureController::class, 'destroy'])->name('features.destroy');

    // ############################ [Projects] Section Route ############################
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects-section-edit', [ProjectSectionController::class, 'edit'])->name('admin.projects.section.edit');
    Route::put('/projects-section', [ProjectSectionController::class, 'update'])->name('admin.projects.section.update');

    Route::get('/projects-categories-create', [ProjectCategoryController::class, 'create'])->name('admin.projects.categories.create');
    Route::post('/projects-categories-store', [ProjectCategoryController::class, 'store'])->name('admin.projects.categories.store');
    Route::get('/projects-categories-edit/{id}', [ProjectCategoryController::class, 'edit'])->name('admin.projects.categories.edit');
    Route::put('/projects-categories-update/{id}', [ProjectCategoryController::class, 'update'])->name('admin.projects.categories.update');
    Route::delete('/projects-categories/{id}', [ProjectCategoryController::class, 'destroy'])->name('admin.projects.categories.destroy');

    Route::get('/projects-images-create/{id}', [ProjectImageController::class, 'create'])->name('admin.projects.images.create');
    Route::post('/projects-images', [ProjectImageController::class, 'store'])->name('admin.projects.images.store');
    Route::get('/projects-images-edit/{id}', [ProjectImageController::class, 'edit'])->name('admin.projects.images.edit');
    Route::put('/projects-images/{id}', [ProjectImageController::class, 'update'])->name('admin.projects.images.update');
    Route::delete('/projects-images/{id}', [ProjectImageController::class, 'destroy'])->name('admin.projects.images.destroy');

    // ############################ [Services] Section Route ############################
    Route::get('section-services', [ServiceSectionController::class, 'index'])->name('section_services.index');
    Route::get('section-services/{id}', [ServiceSectionController::class, 'edit'])->name('section_services.edit');
    Route::put('section-services/{id}', [ServiceSectionController::class, 'update'])->name('section_services.update');

    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('services-edit/{id}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // ############################ [Testmonials] Section Route ############################
    Route::get('section-testmonials',       [SectionTestimonialController::class, 'index'])->name('section_testimonials.index');
    Route::get('section-testimonials/{id}', [SectionTestimonialController::class, 'edit'])->name('section_testimonials.edit');
    Route::put('section-testimonials/{id}', [SectionTestimonialController::class, 'update'])->name('section_testimonials.update');

    Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('testimonials-edit/{id}', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // ############################ [Contact] Section Route ############################
    // ############################ [Contact] Section Route ############################
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');

    // ############################ [Contact Settings] Section Route ############################
    Route::get('/contact-settings', [ContactSettingController::class, 'edit'])->name('admin.contact-settings.edit');
    Route::put('/contact-settings', [ContactSettingController::class, 'update'])->name('admin.contact-settings.update');

    // ############################ [Counters] Section Route ############################
    Route::get('counters', [CounterController::class, 'index'])->name('admin.counters.index');
    Route::get('counters/create', [CounterController::class, 'create'])->name('admin.counters.create');
    Route::post('counter-store', [CounterController::class, 'store'])->name('admin.counters.store');
    Route::post('counter-edit', [CounterController::class, 'edit'])->name('admin.counters.edit');
    Route::post('counter-update', [CounterController::class, 'update'])->name('admin.counters.update');
    Route::delete('counter-destroy', [CounterController::class, 'destroy'])->name('admin.counters.destroy');

    // ############################ [About] Section Route ############################
    Route::get('/about', [AboutSectionController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about', [AboutSectionController::class, 'update'])->name('admin.about.update');
    Route::post('/about/points', [AboutSectionController::class, 'storePoint'])->name('admin.about.points.store');
    Route::delete('/about/points/{id}', [AboutSectionController::class, 'destroyPoint'])->name('admin.about.points.destroy');

    // ############################ [Clients] Section Route ############################
    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index')->name('admin.clients.index');
        Route::get('/clients/create', 'create')->name('admin.clients.create');
        Route::post('/clients/store', 'store')->name('admin.clients.store');
        Route::post('/clients/edit', 'edit')->name('admin.clients.edit');
        Route::post('/clients/update', 'update')->name('admin.clients.update');
        Route::post('/clients/destroy', 'destroy')->name('admin.clients.destroy');
    });

    // ############################ [CTA] Section Route ############################
    Route::get('/cta', [CtaSectionController::class, 'edit'])->name('admin.cta.edit');
    Route::put('/cta', [CtaSectionController::class, 'update'])->name('admin.cta.update');

    // ############################ [Blog] Section Route ############################
    Route::get('posts', [BlogPostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [BlogPostController::class, 'create'])->name('admin.posts.create');
    Route::post('posts-store', [BlogPostController::class, 'store'])->name('admin.posts.store');
    Route::post('posts-edit', [BlogPostController::class, 'edit'])->name('admin.posts.edit');
    Route::post('posts-update', [BlogPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('posts-destroy', [BlogPostController::class, 'destroy'])->name('admin.posts.destroy');

    // ############################ [Blog Settings] ############################
    Route::get('/blog-section', [BlogSectionController::class, 'edit'])->name('admin.blog.section.edit');
    Route::post('/blog-section', [BlogSectionController::class, 'update'])->name('admin.blog.section.update');

    // ############################ [SEO Settings] ############################
    Route::get('/seo-settings', [SeoSettingController::class, 'edit'])->name('admin.seo.edit');
    Route::post('/seo-settings', [SeoSettingController::class, 'update'])->name('admin.seo.update');
});
