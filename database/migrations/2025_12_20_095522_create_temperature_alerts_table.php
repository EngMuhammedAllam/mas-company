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
        Schema::create('temperature_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooling_sensor_id')->constrained()->onDelete('cascade');
            $table->decimal('temperature', 8, 2);
            $table->string('threshold_type'); // high or low
            $table->decimal('threshold_value', 8, 2);
            $table->enum('severity', ['info', 'warning', 'critical'])->default('warning');
            $table->boolean('is_resolved')->default(false);
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperature_alerts');
    }
};
