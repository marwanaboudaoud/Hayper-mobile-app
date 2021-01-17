<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginValid()
    {
        $userFactory = factory(User::class)->create([
            'is_active' => true
        ]);

        $response = $this->post('/api/login', [
            'email' => $userFactory->email,
            'password' => 'password'
        ]);

        $userFactory->delete();

        $response->assertJsonStructure([
            'token',
            'user'
        ])->assertStatus(200);
    }

    public function testLoginValidInactive()
    {
        $userFactory = factory(User::class)->create([
            'is_active' => false
        ]);

        $response = $this->post('/api/login', [
            'email' => $userFactory->email,
            'password' => 'password'
        ]);

        $userFactory->delete();

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(403);
    }

    public function testInvalidEmailAndPasswordLogin()
    {
        $response = $this->post('/api/login', [
            'email' => 'ricky@holygrow.nl',
            'password' => 'password'
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);
    }

    public function testInvalidEmailLogin()
    {
        $userFactory = factory(User::class)->create();

        $response = $this->post('/api/login', [
            'email' => 'ricky@holygrow.nl',
            'password' => 'password'
        ]);

        $userFactory->delete();

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);


    }

    public function testInvalidPasswordLogin()
    {
        $userFactory = factory(User::class)->create();

        $response = $this->post('/api/login', [
            'email' => $userFactory->email,
            'password' => '123'
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);
    }

    public function testInvalidEmailInputLogin()
    {
        $response = $this->post('/api/login', [
            'email' => 'test',
            'password' => '123'
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(422);
    }
}
