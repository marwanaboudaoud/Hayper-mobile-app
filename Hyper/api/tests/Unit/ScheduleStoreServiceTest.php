<?php

namespace Tests\Unit;

use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use App\Src\Services\Hyper\Availability\IAvailabilityCountService;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;
use App\Src\Services\Hyper\Schedule\ScheduleStoreService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ScheduleStoreServiceTest extends TestCase
{
    /**
     * @var ScheduleModel
     */
    private $scheduleModel;

    /**
     * @var IScheduleRepository
     */
    private $scheduleStoreRepo;

    /**
     * @var IAvailabilityCountService
     */
    private $countService;

    /**
     * @var IAvailabilityShiftService
     */
    private $availabilityShiftService;

    public function setUp(): void
    {
        parent::setUp();

        $this->scheduleModel = m::mock(ScheduleModel::class, function ($mock) {
            $mock->shouldReceive('getDate')
                ->andReturn(Carbon::now());

            $mock->shouldReceive('getDriver')
                ->andReturn((new UserModel()));

            $mock->shouldReceive('getEmployees')
                ->andReturn(collect());

            $mock->shouldReceive('getAvailabilityShiftId')
                ->andReturn(1);
        });

        $this->scheduleStoreRepo = m::mock(IScheduleRepository::class, function ($mock) {
            $mock->shouldReceive('store')
                ->with(ScheduleModel::class)
                ->andReturn($this->scheduleModel);

            $mock->shouldReceive('scheduledEmployees')
                ->with(ScheduleModel::class)
                ->andReturn($this->scheduleModel);
        });

        $this->availabilityShiftService =  m::mock(IAvailabilityShiftService::class, function ($mock) {
            $mock->shouldReceive('rules')
                ->with(Collection::class)
                ->andReturn(collect(1));
        });

        $this->countService = m::mock(IAvailabilityCountService::class, function ($mock) {
            $mock->shouldReceive('count')
                ->andReturn(1);
        });
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStore()
    {
        $service = new ScheduleStoreService($this->scheduleStoreRepo, $this->countService,
            $this->availabilityShiftService
        );
        $result = $service->store($this->scheduleModel);

        $this->assertInstanceOf(ScheduleModel::class, $result);
    }
}
