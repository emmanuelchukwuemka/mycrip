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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('currency', 3)->default('NGN');
            $table->enum('interval', ['daily', 'weekly', 'monthly', 'annually'])->default('monthly');
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_limit')->default(0);
            $table->integer('listing_limit')->default(0);
            $table->integer('promoted_listings_limit')->default(0);
            $table->timestamps();
            
            $table->index(['is_active']);
            $table->index(['price']);
            $table->index(['interval']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
