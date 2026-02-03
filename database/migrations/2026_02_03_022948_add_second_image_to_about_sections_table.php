<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->string('current_img_2')->nullable()->after('current_img');
            $table->string('prev_img_2_1')->nullable()->after('prev_img_4');
            $table->string('prev_img_2_2')->nullable()->after('prev_img_2_1');
            $table->string('prev_img_2_3')->nullable()->after('prev_img_2_2');
            $table->string('prev_img_2_4')->nullable()->after('prev_img_2_3');
        });
    }

    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->dropColumn(['current_img_2', 'prev_img_2_1', 'prev_img_2_2', 'prev_img_2_3', 'prev_img_2_4']);
        });
    }
};