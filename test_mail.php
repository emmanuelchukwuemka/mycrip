<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    Mail::raw('This is a test email to verify SMTP settings for MyCrip OTP flow.', function ($message) {
        $message->to('nwekee125@gmail.com')
                ->subject('SMTP Configuration Test - MyCrip');
    });
    echo "Test email sent successfully!\n";
} catch (\Exception $e) {
    echo "Failed to send test email: " . $e->getMessage() . "\n";
    Log::error("SMTP Test Failure: " . $e->getMessage());
}
