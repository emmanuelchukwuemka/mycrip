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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->string('image_hash', 64)->unique(); // SHA-256 hash for duplicate detection
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('caption')->nullable();
            $table->timestamps();
            
            // Index for duplicate detection
            $table->index('image_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
