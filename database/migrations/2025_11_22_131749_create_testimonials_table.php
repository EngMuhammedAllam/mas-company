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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable();
            $table->text('message');
            $table->string('sort_order')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('section_testimonial_id')->nullable();
            $table->foreign('section_testimonial_id')->references('id')->on('section_testimonials')->onDelete('set null');
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
