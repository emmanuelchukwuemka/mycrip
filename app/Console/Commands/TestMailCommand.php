<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test OTP email to the specified address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $this->info("Sending test OTP email to: {$email}");

        try {
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\PasswordResetOtp('123456'));
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
        }
    }
}
