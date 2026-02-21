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
            $table->text('bio')->nullable()->after('agent_address');
            $table->string('agent_promise')->nullable()->after('bio');
            $table->integer('experience_years')->nullable()->after('agent_promise');
            $table->string('specialties')->nullable()->after('experience_years');
            $table->string('license_number')->nullable()->after('specialties');
            $table->string('profile_photo_path')->nullable()->after('license_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'agent_promise',
                'experience_years',
                'specialties',
                'license_number',
                'profile_photo_path',
            ]);
        });
    }
};
