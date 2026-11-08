<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Anonymous CTA analytics only.
     * Deliberately stores no customer message, phone number or IP address.
     */
    public function up(): void
    {
        Schema::create('whatsapp_interactions', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->foreignId('equipment_product_id')
                ->nullable()
                ->constrained('equipment_products')
                ->nullOnDelete();
            $table->string('action_type');
            $table->timestamp('created_at')->nullable();

            $table->index('source');
            $table->index('action_type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_interactions');
    }
};
