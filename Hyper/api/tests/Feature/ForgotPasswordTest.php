<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testForgotPassword()
    {
        $userFactory = factory(User::class)->create([
            'is_active' => true
        ]);

        $response = $this->post('api/forgot-password', [
            'email' => $userFactory->email,
            'host' => 'http://example.nl'
        ]);

        $response->assertStatus(200);
    }

    public function testWithInvalidEmailAndPassword()
    {
        $response = $this->post('api/forgot-password', [
            'email' => 'test@test.nl',
            'host' => 'http://example.nl'
        ]);

        $response->assertStatus(404);
    }
}
