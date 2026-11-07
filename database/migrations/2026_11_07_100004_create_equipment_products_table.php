<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_category_id')
                ->constrained('equipment_categories')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('kicker')->nullable();
            $table->text('description');
            $table->string('image');
            $table->string('image_alt')->nullable();
            // square | wide | xwide
            $table->string('media_shape')->default('wide');
            $table->string('availability_label')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->json('specifications')->nullable();
            $table->text('whatsapp_price_message')->nullable();
            $table->text('whatsapp_details_message')->nullable();
            $table->text('whatsapp_specs_message')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
            $table->index(['equipment_category_id', 'is_active'], 'equipment_products_category_active_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_products');
    }
};
