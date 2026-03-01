<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('login_locked_until')->nullable()->after('remember_token');
            $table->timestamp('last_login_at')->nullable()->after('login_locked_until');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
            $table->string('last_login_device')->nullable()->after('last_login_ip');
            $table->string('referral_code', 16)->nullable()->unique()->after('last_login_device');
            $table->boolean('account_deleted')->default(false)->after('referral_code');
            $table->timestamp('account_deleted_at')->nullable()->after('account_deleted');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['login_locked_until','last_login_at','last_login_ip','last_login_device','referral_code','account_deleted','account_deleted_at']);
        });
    }
};
