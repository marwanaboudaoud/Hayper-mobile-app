<?php

namespace Tests\Feature;

use App\ForgotPasswordToken;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testResetPassword()
    {
        $forgotPasswordToken = factory(ForgotPasswordToken::class)->create();

        $response = $this->post('/api/reset-password', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $forgotPasswordToken->token
        ]);

        $response->assertStatus(204);

        $forgotPasswordToken->delete();
    }

    public function testResetPasswordTwice()
    {
        $forgotPasswordToken = factory(ForgotPasswordToken::class)->create();

        $this->post('/api/reset-password', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $forgotPasswordToken->token
        ]);

        $response = $this->post('/api/reset-password', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $forgotPasswordToken->token
        ]);

        $response->assertStatus(409);

        $forgotPasswordToken->delete();
    }

    public function testResetPasswordPasswordAndPasswordConfirmationNotEqual()
    {
        $forgotPasswordToken = factory(ForgotPasswordToken::class)->create();

        $response = $this->post('/api/reset-password', [
            'password' => 'password1',
            'password_confirmation' => 'password',
            'token' => $forgotPasswordToken->token
        ]);

        $response->assertStatus(422);

        $forgotPasswordToken->delete();
    }

    public function testResetPasswordInvalidToken()
    {
        $response = $this->post('/api/reset-password', [
            'password' => 'password1',
            'password_confirmation' => 'password1',
            'token' => 'test'
        ]);

        $response->assertStatus(404);
    }

    public function testTokenAlreadyUsed()
    {
        $forgotPasswordToken = factory(ForgotPasswordToken::class)->create([
            'is_used' => 1
        ]);

        $response = $this->post('/api/reset-password', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $forgotPasswordToken->token
        ]);

        $response->assertStatus(409);

        $forgotPasswordToken->delete();
    }
}
