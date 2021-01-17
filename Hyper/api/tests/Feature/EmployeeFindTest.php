<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeFindTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFind()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get('/api/employees/' . $loginUser->id, [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testNotFound()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get('/api/employees/0', [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(404);
    }
}
