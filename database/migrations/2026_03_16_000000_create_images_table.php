<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates a comprehensive image management table with full metadata
     * including path, dimensions, file type, and visibility status.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');                    // Original filename
            $table->string('path');                        // Full storage path
            $table->string('url');                         // Public URL for access
            $table->string('extension');                  // File extension (jpg, png, gif, webp, etc.)
            $table->string('mime_type');                  // MIME type (image/jpeg, image/png, etc.)
            $table->integer('width')->nullable();         // Image width in pixels
            $table->integer('height')->nullable();        // Image height in pixels
            $table->integer('file_size')->nullable();     // File size in bytes
            $table->string('alt_text')->nullable();       // Alt text for accessibility
            $table->string('title')->nullable();          // Image title
            $table->string('caption')->nullable();       // Image caption
            $table->string('category')->nullable();        // Category (news, gallery, products, etc.)
            $table->string('context')->nullable();        // Context/usage (hero, thumbnail, banner, etc.)
            $table->unsignedBigInteger('imageable_id')->nullable();   // Polymorphic ID
            $table->string('imageable_type')->nullable(); // Polymorphic relation type
            $table->boolean('is_visible')->default(true);  // Visibility status
            $table->boolean('is_primary')->default(false); // Primary image flag
            $table->integer('sort_order')->default(0);    // Sort order for display
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign key for uploaded_by
            $table->foreign('uploaded_by')->references('id')->on('admins')->onDelete('set null');
            
            // Indexes for better query performance
            $table->index(['category', 'is_visible']);
            $table->index(['imageable_id', 'imageable_type']);
            $table->index('is_visible');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
