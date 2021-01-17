<?php

namespace Tests\Unit;

use App\Schedule;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use App\Src\Services\Hyper\Schedule\ScheduleDeleteService;
use App\Src\Services\Hyper\Schedule\ScheduleService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ScheduleDeleteServiceTest extends TestCase
{
    /**
     * @var IScheduleRepository|m\LegacyMockInterface|m\MockInterface
     */
    private $scheduleRepo;

    private $invalidScheduleRepo;

    public function setUp(): void
    {
        parent::setUp();

        $this->scheduleRepo = m::mock(IScheduleRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(
                    ScheduleModel::class
                );

            $mock->shouldReceive('delete')
                ->with(1)
                ->andReturn(
                    true
                );
        });
        $this->invalidScheduleRepo = m::mock(IScheduleRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(
                    false
                );
        });
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $service = new ScheduleDeleteService($this->scheduleRepo);
        $result = $service->delete(1);

        $this->assertTrue($result);
    }

    public function testDeleteNoFoundSchedule()
    {
        $this->expectException(\Exception::class);


        $service = new ScheduleDeleteService($this->invalidScheduleRepo);
        $service->delete(1);
    }
}
