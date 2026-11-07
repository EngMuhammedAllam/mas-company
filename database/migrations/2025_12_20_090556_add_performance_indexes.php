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
        // Blog Posts indexes
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index(['is_active', 'published_at']);
            $table->index('published_at');
        });

        // Testimonials indexes
        Schema::table('testimonials', function (Blueprint $table) {
            $table->index(['section_testimonial_id', 'active', 'sort_order']);
        });

        // Services indexes
        Schema::table('services', function (Blueprint $table) {
            $table->index(['service_section_id', 'is_active', 'sort_order']);
        });

        // Project Categories indexes
        Schema::table('project_categories', function (Blueprint $table) {
            $table->index('is_active');
        });

        // Blog Categories indexes
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'published_at']);
            $table->dropIndex(['published_at']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex(['section_testimonial_id', 'active', 'sort_order']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['service_section_id', 'is_active', 'sort_order']);
        });

        Schema::table('project_categories', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });
    }
};
