<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->string('highlighted_text')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('button_text')->nullable();
            $table->text('whatsapp_message')->nullable();
            $table->string('secondary_button_text')->nullable();
            $table->text('secondary_whatsapp_message')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
