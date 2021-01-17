<?php

namespace Tests\Feature;

use App\Availability;
use App\AvailabilityShift;
use App\Exceptions\Availability\AvailabilityNotFoundException;
use App\Exceptions\NoAvailabilityFoundException;
use App\Partner;
use App\Project;
use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleStoreTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $driver = factory(User::class)->create([
            'has_drivers_license' => true
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $date = Carbon::now()->addYear(rand(1, 100))->toDateString();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id,
            'is_present' => 1,
            'date' => $date
        ]);

        $availability = factory(Availability::class)->create([
            'user_id' => $driver->id,
            'availability_shift_id' => $shift->id,
            'is_present' => 1,
            'date' => $date
        ]);

        $response = $this->post('/api/schedules/store', [
            'items' => [
                [
                    'project_id' => factory(Project::class)->create([
                        'partner_id' => factory(Partner::class)->create()->id
                    ])->id,
                    'name' => 'Albert heijn',
                    'address' => 'Pergolesistraat 18',
                    'postcode' => '2901PA',
                    'city' => 'Capelle aan den IJssel',
                    'date' => $date,
                    'driver' => $driver->id,
                    'availability_shift_id' => $shift->id,
                    'employees' => [$user->id],
                ]
            ]
        ], [
            'api-key' => $this->user->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testInvalidEmployeeStore()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $driver = factory(User::class)->create([
            'has_drivers_license' => true
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $date = Carbon::now()->toDateString();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id,
            'is_present' => 1,
            'date' => $date
        ]);

        $availability = factory(Availability::class)->create([
            'user_id' => $driver->id,
            'availability_shift_id' => $shift->id,
            'is_present' => 1,
            'date' => $date
        ]);

        $response = $this->post('/api/schedules/store', [
            'items' => [
                [
                    'project_id' => factory(Project::class)->create([
                        'partner_id' => factory(Partner::class)->create()->id
                    ])->id,
                    'name' => 'Albert heijn',
                    'address' => 'Pergolesistraat 18',
                    'postcode' => '2901PA',
                    'city' => 'Capelle aan den IJssel',
                    'date' => $date,
                    'driver' => $driver->id,
                    'availability_shift_id' => $shift->id,
                    'employees' => [0],
                ]
            ]
        ], [
            'api-key' => $this->user->api_token
        ]);

        $response->assertStatus(404);

    }

    public function testInvalidDriverStore()
    {

        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $driver = factory(User::class)->create([
            'has_drivers_license' => true
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $date = Carbon::now()->toDateString();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id,
            'is_present' => 1,
            'date' => $date
        ]);

        $availability = factory(Availability::class)->create([
            'user_id' => $driver->id,
            'availability_shift_id' => $shift->id,
            'is_present' => 1,
            'date' => $date
        ]);

        $response = $this->post('/api/schedules/store', [
            'items' => [
                [
                    'project_id' => factory(Project::class)->create([
                        'partner_id' => factory(Partner::class)->create()->id
                    ])->id,
                    'name' => 'Albert heijn',
                    'address' => 'Pergolesistraat 18',
                    'postcode' => '2901PA',
                    'city' => 'Capelle aan den IJssel',
                    'date' => $date,
                    'driver' => -0,
                    'availability_shift_id' => $shift->id,
                    'employees' => [$user->id],
                ]
            ]
        ], [
            'api-key' => $this->user->api_token
        ]);

        $response->assertStatus(404);
    }
}
