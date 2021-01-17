<?php

namespace Tests\Feature;

use App\ActivateUserToken;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivateEmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testActivateToken()
    {
        $activateEmployeeToken = factory(ActivateUserToken::class)->create();

        $response = $this->post('api/employees/activate', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $activateEmployeeToken->token
        ]);

        $response->assertStatus(204);
    }

    public function testActivateTokenAlreadyUsed()
    {
        $activateEmployeeToken = factory(ActivateUserToken::class)->create([
            'is_used' => 1
        ]);

        $response = $this->post('api/employees/activate', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $activateEmployeeToken->token
        ]);

        $response->assertStatus(409);
    }

    public function testActivateTokenNotFound()
    {
        $response = $this->post('api/employees/activate', [
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => 'abc'
        ]);

        $response->assertStatus(500);
    }
}
