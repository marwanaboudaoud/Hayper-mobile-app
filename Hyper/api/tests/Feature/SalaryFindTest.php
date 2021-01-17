<?php

namespace Tests\Feature;

use App\Salary;
use App\User;
use Illuminate\Database\Console\Seeds\SeedCommand;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaryFindTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFind()
    {
        $salary = factory(Salary::class, 1)->create()->first();

        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get('/api/salaries/' . $salary->id, [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testFindWithNoExistingSalary()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get('/api/salaries/0', [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(404);
    }
}
