<?php

namespace Tests\Unit;

use App\Exceptions\Availability\DateExceededExpireDate;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Availability\IAvailabilityRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\IAuthService;
use App\Src\Services\Hyper\Availability\AvailabilityStoreService;
use App\Src\Services\Hyper\Availability\IAvailabilityDateValidatorService;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class AvailabilityStoreServiceTest extends TestCase
{
    /**
     * @var IAvailabilityRepository
     */
    private $repo;

    /**
     * @var IAuthService
     */
    private $authService;

    /**
     * @var IAvailabilityShiftService
     */
    private $availabilityShiftService;
    /**
     * @var IAvailabilityDateValidatorService
     */
    private $dateValidator;


    public function setUp(): void
    {
        parent::setUp();

        $this->repo = $this->instance(IAvailabilityRepository::class, m::mock(IAvailabilityRepository::class, function ($mock) {
            $mock->shouldReceive('store')
                ->with(AvailabilityModel::class)
                ->andReturn((new UserModel()));
        }));

        $this->availabilityShiftService = $this->instance(IAvailabilityShiftService::class, m::mock(IAvailabilityShiftService::class, function ($mock) {

        }));

        $this->authService = $this->instance(IAuthService::class, m::mock(IAuthService::class, function ($mock) {
            $mock->shouldReceive('checkApiToken')
                ->andReturn((new UserModel()));
        }));

        $this->dateValidator = $this->instance(IAvailabilityDateValidatorService::class, m::mock(IAvailabilityDateValidatorService::class, function ($mock) {
            $mock->shouldReceive('validate')
                ->with(AvailabilityModel::class);
        }));
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStore()
    {
        $service = new AvailabilityStoreService(
            $this->repo,
            $this->availabilityShiftService,
            $this->authService,
            $this->dateValidator
        );
        $service->store((new AvailabilityModel())->setDate(Carbon::now()->startOfWeek()->addWeeks(2))->setApiToken('abc'));
    }

//    public function testException()
//    {
//        $this->expectException(DateExceededExpireDate::class);
//
//        $service = new AvailabilityStoreService(
//            $this->repo,
//            $this->availabilityShiftService,
//            $this->authService
//        );
//        $service->store((new AvailabilityModel())->setDate(Carbon::now()->startOfWeek()->addWeeks(1))->setApiToken('abc'));
//    }
}
