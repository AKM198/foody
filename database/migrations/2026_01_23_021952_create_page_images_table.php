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
        Schema::create('page_images', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); // 'home', 'about'
            $table->string('section_name'); // 'hero_image', 'menu_card_1', etc.
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->timestamps();
            
            $table->unique(['page_name', 'section_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_images');
    }
};
