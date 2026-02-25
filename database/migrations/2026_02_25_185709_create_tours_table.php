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
        Schema::create('tours', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('property_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $blueprint->string('guest_name')->nullable();
            $blueprint->string('guest_email')->nullable();
            $blueprint->string('guest_phone')->nullable();
            $blueprint->date('preferred_date');
            $blueprint->string('preferred_time');
            $blueprint->text('message')->nullable();
            $blueprint->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
