<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('agent_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('property_id')->nullable()->constrained('properties')->onDelete('set null');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();

            $table->unique(['customer_id', 'agent_id', 'property_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
