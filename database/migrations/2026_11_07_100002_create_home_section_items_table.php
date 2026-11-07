<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Repeater rows that belong to a home page section
     * (hero proof points, trust items, advice points, process steps, FAQs).
     * They are edited inline inside the central Home Page Editor.
     */
    public function up(): void
    {
        Schema::create('home_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_section_id')
                ->constrained('home_sections')
                ->cascadeOnDelete();
            // hero_proof | trust_item | advice_point | process_step | faq_item
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('label')->nullable();
            $table->string('icon_key')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['type', 'is_active', 'sort_order'], 'home_section_items_listing_index');
            $table->index(['home_section_id', 'sort_order'], 'home_section_items_section_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_section_items');
    }
};
