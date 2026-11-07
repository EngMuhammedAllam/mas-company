<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Blog Posts Indexes
        Schema::table('blog_posts', function (Blueprint $table) {
            $indexes = collect(Schema::getIndexes('blog_posts'))->pluck('name')->toArray();

            if (!in_array('blog_posts_is_active_index', $indexes)) {
                $table->index('is_active');
            }
            if (!in_array('blog_posts_published_at_index', $indexes)) {
                $table->index('published_at');
            }
            if (!in_array('blog_posts_blog_category_id_index', $indexes)) {
                $table->index('blog_category_id');
            }
        });

        // Service Sections Indexes
        Schema::table('service_sections', function (Blueprint $table) {
            $indexes = collect(Schema::getIndexes('service_sections'))->pluck('name')->toArray();

            if (!in_array('service_sections_is_active_index', $indexes)) {
                $table->index('is_active');
            }
        });

        // Testimonials Indexes
        Schema::table('testimonials', function (Blueprint $table) {
            $indexes = collect(Schema::getIndexes('testimonials'))->pluck('name')->toArray();

            if (!in_array('testimonials_section_testimonial_id_index', $indexes)) {
                $table->index('section_testimonial_id');
            }
            if (!in_array('testimonials_active_index', $indexes)) {
                $table->index('active');
            }
        });

        // Services Indexes
        Schema::table('services', function (Blueprint $table) {
            $indexes = collect(Schema::getIndexes('services'))->pluck('name')->toArray();

            if (!in_array('services_service_section_id_index', $indexes)) {
                $table->index('service_section_id');
            }
            if (!in_array('services_is_active_index', $indexes)) {
                $table->index('is_active');
            }
        });

        // Cooling Sensors Index
        Schema::table('cooling_sensors', function (Blueprint $table) {
            $indexes = collect(Schema::getIndexes('cooling_sensors'))->pluck('name')->toArray();

            if (!in_array('cooling_sensors_sensor_key_index', $indexes)) {
                $table->index('sensor_key');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['blog_category_id']);
        });

        Schema::table('service_sections', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex(['section_testimonial_id']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['service_section_id']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('cooling_sensors', function (Blueprint $table) {
            $table->dropIndex(['sensor_key']);
        });
    }
};
