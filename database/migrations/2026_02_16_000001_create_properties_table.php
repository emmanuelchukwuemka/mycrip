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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['house_rental', 'house_purchase', 'land_purchase', 'shop_rental', 'student_lodge']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // Location
            $table->string('country')->default('Nigeria');
            $table->string('state');
            $table->string('city');
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            
            // Price
            $table->decimal('price', 15, 2);
            $table->enum('price_type', ['monthly', 'yearly', 'fixed'])->default('fixed');
            
            // Property Features
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('toilets')->nullable();
            $table->string('size')->nullable(); // e.g., "120 sqm"
            $table->boolean('furnished')->default(false);
            $table->boolean('serviced')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('security')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('power_supply')->default(false);
            $table->string('featured_image')->nullable();
            
            // Features as JSON for flexibility
            $table->json('features')->nullable();
            
            $table->timestamps();
            
            // Indexes for filtering
            $table->index(['category', 'status']);
            $table->index(['country', 'state', 'city']);
            $table->index(['price']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
