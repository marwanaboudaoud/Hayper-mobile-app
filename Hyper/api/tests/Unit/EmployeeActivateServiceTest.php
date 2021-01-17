<?php

namespace Tests\Unit;

use App\Exceptions\Employee\ActivateTokenNotSetException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Employee\EmployeeActivateModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Employee\EmployeeActivateService;
use App\Src\Services\Hyper\Token\ActivateUserTokenService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class EmployeeActivateServiceTest extends TestCase
{
    private $employeeService;

    private $invalidToken;

    public function setUp(): void
    {
        parent::setUp();

        $activateUserService =  m::mock(ActivateUserTokenService::class, function ($mock) {});
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByEmail')
                ->with('ricky@holygrow.nl')
                ->andReturn(null);
            $mock->shouldReceive('store')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);
                        $mock->shouldReceive('getAddress')
                            ->andReturn(m::mock(AddressModel::class, function ($mock) {
                                $mock->shouldReceive('setUser')
                                    ->andReturn($mock);

                                $mock->shouldReceive('setActive')
                                    ->with(true)
                                    ->andReturn($mock);
                            }));
                        $mock->shouldReceive('setPassword')
                            ->andReturn();
                    })
                );
        }));

        $this->invalidToken = m::mock(EmployeeActivateModel::class, function ($mock) {
            $mock->shouldReceive('getToken')
                ->andReturn(
                    null
                );
        });
        $this->employeeService = new EmployeeActivateService($activateUserService, $userRepository);
    }


    public function testWithWithoutToken()
    {
        $this->expectException(ActivateTokenNotSetException::class);

        $this->employeeService->activate($this->invalidToken);
    }
}
