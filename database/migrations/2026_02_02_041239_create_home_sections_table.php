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
            $table->string('section_name');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('current_img')->nullable();
            $table->string('prev_img_1')->nullable();
            $table->string('prev_img_2')->nullable();
            $table->string('prev_img_3')->nullable();
            $table->string('prev_img_4')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};