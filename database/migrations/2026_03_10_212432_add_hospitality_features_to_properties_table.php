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
        // Add extra fields - wrap in checks for SQLite compatibility where migrations might partially run
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'total_rooms')) {
                $table->integer('total_rooms')->nullable()->after('price_type');
            }
            if (!Schema::hasColumn('properties', 'has_pool')) {
                $table->boolean('has_pool')->default(false)->after('power_supply');
            }
            if (!Schema::hasColumn('properties', 'has_gym')) {
                $table->boolean('has_gym')->default(false)->after('has_pool');
            }
            if (!Schema::hasColumn('properties', 'has_conference_room')) {
                $table->boolean('has_conference_room')->default(false)->after('has_gym');
            }
            if (!Schema::hasColumn('properties', 'has_restaurant')) {
                $table->boolean('has_restaurant')->default(false)->after('has_conference_room');
            }
            if (!Schema::hasColumn('properties', 'security_level')) {
                $table->string('security_level')->nullable()->after('security');
            }
            if (!Schema::hasColumn('properties', 'parking_capacity')) {
                $table->integer('parking_capacity')->nullable()->after('parking');
            }
        });

        // Update category enum - SQLite doesn't strictly enforce enums, so we can skip raw SQL here
        // In a production MySQL environment, you would use:
        // DB::statement("ALTER TABLE properties MODIFY COLUMN category ENUM('house_rental', 'house_purchase', 'land_purchase', 'shop_rental', 'student_lodge', 'hotel', 'lodge') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'total_rooms',
                'has_pool',
                'has_gym',
                'has_conference_room',
                'has_restaurant',
                'security_level',
                'parking_capacity'
            ]);
        });

        // In production MySQL:
        // DB::statement("ALTER TABLE properties MODIFY COLUMN category ENUM('house_rental', 'house_purchase', 'land_purchase', 'shop_rental', 'student_lodge') NOT NULL");
    }
};
