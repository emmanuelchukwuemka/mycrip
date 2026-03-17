<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Mail\PasswordResetOtp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Tests\TestCase;

class PasswordResetOtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_otp()
    {
        Mail::fake();
        $user = User::factory()->create(['email' => 'test@example.com']);

        $response = $this->post(route('password.email'), [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect(route('password.otp.verify', ['email' => 'test@example.com']));
        $this->assertDatabaseHas('password_reset_codes', [
            'email' => 'test@example.com',
        ]);

        Mail::assertSent(PasswordResetOtp::class, function ($mail) {
            return $mail->hasTo('test@example.com') && !empty($mail->code);
        });
    }

    public function test_user_cannot_request_otp_for_invalid_email()
    {
        $response = $this->post(route('password.email'), [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_user_can_verify_correct_otp()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $code = '123456';
        
        DB::table('password_reset_codes')->insert([
            'email' => 'test@example.com',
            'code' => $code,
            'created_at' => Carbon::now(),
        ]);

        $response = $this->post(route('password.otp.verify.post'), [
            'email' => 'test@example.com',
            'code' => $code,
        ]);

        $response->assertRedirect(route('password.reset', ['token' => 'otp-verified']));
        $this->assertEquals('test@example.com', session('reset_email'));
        $this->assertDatabaseMissing('password_reset_codes', ['email' => 'test@example.com']);
    }

    public function test_user_cannot_verify_incorrect_otp()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        
        DB::table('password_reset_codes')->insert([
            'email' => 'test@example.com',
            'code' => '123456',
            'created_at' => Carbon::now(),
        ]);

        $response = $this->post(route('password.otp.verify.post'), [
            'email' => 'test@example.com',
            'code' => 'wrong!',
        ]);

        $response->assertSessionHasErrors('code');
    }

    public function test_user_can_reset_password_after_otp_verification()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create(['email' => 'test@example.com']);

        $response = $this->withSession(['reset_email' => 'test@example.com'])
            ->post(route('password.update'), [
                'token' => 'otp-verified',
                'email' => 'test@example.com',
                'password' => 'new-password-too',
                'password_confirmation' => 'new-password-too',
            ]);

        $response->assertRedirect('/dashboard');
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('new-password-too', $user->fresh()->password));
        $this->assertNull(session('reset_email'));
    }
}
