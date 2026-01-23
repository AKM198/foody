<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); // 'home', 'about'
            $table->string('section_name'); // 'hero_title', 'hero_description', etc.
            $table->string('content_type')->default('text'); // 'text', 'image', 'html'
            $table->text('content_value');
            $table->timestamps();
            
            $table->unique(['page_name', 'section_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
