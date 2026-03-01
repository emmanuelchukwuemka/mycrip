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
        Schema::table('plans', function (Blueprint $table) {
            if (!Schema::hasColumn('plans', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('plans', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('plans', 'price')) {
                $table->decimal('price', 10, 2);
            }
            if (!Schema::hasColumn('plans', 'currency')) {
                $table->string('currency', 3)->default('NGN');
            }
            if (!Schema::hasColumn('plans', 'interval')) {
                $table->enum('interval', ['daily', 'weekly', 'monthly', 'annually'])->default('monthly');
            }
            if (!Schema::hasColumn('plans', 'features')) {
                $table->json('features')->nullable();
            }
            if (!Schema::hasColumn('plans', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('plans', 'order_limit')) {
                $table->integer('order_limit')->default(0);
            }
            if (!Schema::hasColumn('plans', 'listing_limit')) {
                $table->integer('listing_limit')->default(0);
            }
            if (!Schema::hasColumn('plans', 'promoted_listings_limit')) {
                $table->integer('promoted_listings_limit')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
};
