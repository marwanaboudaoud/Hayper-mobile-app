<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAll()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/schedules', [
            'year' => 2020,
            'week' => 2
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testAllInvalidYear()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/schedules', [
            'year' => 2019,
            'week' => 2
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(500);
    }

    public function testAllInvalidWeek()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/schedules', [
            'year' => 2020,
            'week' => -1
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(500);
    }

    public function getEmployeeScheduleTest()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/my-schedule', [
            'start_date' => '2020-02-08',
            'end_date' => '2020-02-15'
        ]);

        $response->assertStatus(200);
    }

}
