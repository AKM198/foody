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
        Schema::create('page_image_history', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('section_name');
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            
            $table->index(['page_name', 'section_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_image_history');
    }
};
