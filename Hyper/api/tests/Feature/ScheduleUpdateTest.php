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

class ScheduleUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $schedule = factory(Schedule::class)->create([
            'project_id' => factory(Project::class)->create([
                'partner_id' => factory(Partner::class)->create()->id
            ]),
            'driver_id' => factory(User::class)->create([
                'is_active' => true
            ])->id,
            'availability_shift_id' => factory(AvailabilityShift::class)->create()->id
        ])->first();
        $employees = factory(User::class, 3)->create();

        $response = $this->post('/api/schedules/' . $schedule->id . '/update', [
            'name' => 'Albert heijn',
            'address' => 'Pergolesistraat 18',
            'postcode' => '2901PA',
            'city' => 'Capelle aan den IJssel',
            'date' => Carbon::now()->toDateString(),
            'driver' => $employees->first()->id,
            'employees' => $employees->pluck('id')->toArray(),
            'project_id' => $schedule->project_id,
            'availability_shift_id' => 1
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }
}
