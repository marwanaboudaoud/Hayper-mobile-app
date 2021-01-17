<?php

namespace Tests\Unit;

use App\Exceptions\Schedule\WeekNumberNotValidException;
use App\Src\Mappers\Hyper\Schedule\EmployeeScheduleModel;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use App\Src\Services\Hyper\Schedule\ScheduleService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ScheduleServiceTest extends TestCase
{
    /**
     * @var PaginationEmployeeScheduleModel
     */
    private $employeeScheduleModel;
    /**
     * @var IScheduleRepository
     */
    private $scheduleRepo;

    public function setUp(): void
    {
        parent::setUp();

        $this->employeeScheduleModel = m::mock(PaginationEmployeeScheduleModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getApiToken')
                ->andReturn('3es3462323fA');

            $mock->shouldReceive('getStartDate')
                ->andReturn(new Carbon('2020-02-07'));

            $mock->shouldReceive('getEndDate')
                ->andReturn(new Carbon('2020-02-14'));

        });
        $this->scheduleRepo = m::mock(IScheduleRepository::class, function ($mock) {
            $mock->shouldReceive('get')
                ->with(Carbon::class, Carbon::class)
                ->andReturn(collect());

            $mock->shouldReceive('getEmployeeSchedule')
                ->andReturn(collect());
        });
    }

    public function testGet()
    {
        $service = new ScheduleService(
            $this->scheduleRepo
        );
        $result = $service->get(1, 2020);

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetWeekNrZero()
    {
        $this->expectException(WeekNumberNotValidException::class);

        $service = new ScheduleService(
            $this->scheduleRepo
        );
        $service->get(0, 2020);
    }

    public function testGetWeekNrNegative()
    {
        $this->expectException(WeekNumberNotValidException::class);

        $service = new ScheduleService(
            $this->scheduleRepo
        );
        $service->get(-1, 2020);
    }

    public function testGetWeekNr52()
    {
        $service = new ScheduleService(
            $this->scheduleRepo
        );
        $result = $service->get(52, 2020);

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetWeekNr53WithValidYear()
    {
        $service = new ScheduleService(
            $this->scheduleRepo
        );
        $result = $service->get(53, 2020);

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetWeekNr53WithInValidYear()
    {
        $this->expectException(WeekNumberNotValidException::class);

        $service = new ScheduleService(
            $this->scheduleRepo
        );
        $service->get(53, 2021);
    }

    public function testGetEmployeeSchedule()
    {
        $service = new ScheduleService(
            $this->scheduleRepo
        );

        $result = $service->getEmployeeSchedule($this->employeeScheduleModel);

        $this->assertInstanceOf(Collection::class, $result);
    }
}
