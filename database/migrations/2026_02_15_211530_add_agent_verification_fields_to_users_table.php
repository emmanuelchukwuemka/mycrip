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
        Schema::table('users', function (Blueprint $table) {
            $table->string('agent_image')->nullable()->after('role');
            $table->string('agent_id_document')->nullable()->after('agent_image');
            $table->string('agent_id_number')->nullable()->after('agent_id_document');
            $table->string('agent_phone')->nullable()->after('agent_id_number');
            $table->text('agent_address')->nullable()->after('agent_phone');
            $table->enum('agent_verification_status', ['pending', 'approved', 'rejected'])->default('pending')->after('agent_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'agent_image',
                'agent_id_document',
                'agent_id_number',
                'agent_phone',
                'agent_address',
                'agent_verification_status',
            ]);
        });
    }
};
