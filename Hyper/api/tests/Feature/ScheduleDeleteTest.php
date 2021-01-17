<?php

namespace Tests\Feature;

use App\AvailabilityShift;
use App\Partner;
use App\Project;
use App\Schedule;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleDeleteTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $schedule = factory(Schedule::class)->create([
            'project_id' => factory(Project::class)->create([
                'partner_id' => factory(Partner::class)->create()->id
            ])->id,
            'driver_id' => factory(User::class)->create()->id,
            'availability_shift_id' => factory(AvailabilityShift::class)->create()->id
        ])->first();

        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/schedules/'. $schedule->id .'/delete', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteInvalidId()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/schedules/0/delete', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(404);
    }
}
