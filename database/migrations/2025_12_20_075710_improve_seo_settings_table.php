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
        Schema::table('seo_settings', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('meta_keywords');
            $table->string('robots')->default('index,follow')->after('canonical_url');
            $table->string('author')->nullable()->after('robots');
            $table->string('og_type')->default('website')->after('og_image');
            $table->string('og_site_name')->nullable()->after('og_type');
            $table->string('twitter_card_type')->default('summary_large_image')->after('twitter_handle');
            $table->string('favicon')->nullable()->after('footer_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            $table->dropColumn([
                'canonical_url',
                'robots',
                'author',
                'og_type',
                'og_site_name',
                'twitter_card_type',
                'favicon'
            ]);
        });
    }
};
