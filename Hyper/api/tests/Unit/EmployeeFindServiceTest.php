<?php

namespace Tests\Unit;

use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use Tests\TestCase;
use Mockery as m;

class EmployeeFindServiceTest extends TestCase
{
    public function testEmployeeFind()
    {
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);
                        $mock->shouldReceive('getAddress')
                            ->andReturn(m::mock(UserModel::class, function ($mock) {
                                $mock->shouldReceive('getId')
                                    ->andReturn(1);
                            }));
                    })
                );
        }));


        $addressRepository = $this->instance(IAddressRepository::class, m::mock(IAddressRepository::class, function ($mock) {
            $mock->shouldReceive('store')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);
                        $mock->shouldReceive('getAddress')
                            ->andReturn(m::mock(UserModel::class, function ($mock) {
                                $mock->shouldReceive('getId')
                                    ->andReturn(1);
                            }));
                    })
                );
        }));

        $emergencyContactRepository = $this->instance(IEmergencyContactRepository::class, m::mock(IEmergencyContactRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);
                    })
                );
        }));

        $userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);
        });

        $service = new EmployeeService($userRepository, $addressRepository, $emergencyContactRepository);
        $service->find($userModel->getId());
    }

    public function testExistingEmployeeFind()
    {
        $this->expectException(EmployeeNotFoundException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(200)
                ->andReturn(
                    null
                );
        }));

        $addressRepository = $this->instance(IAddressRepository::class, m::mock(IAddressRepository::class));

        $emergencyContactRepository = $this->instance(IEmergencyContactRepository::class, m::mock(IEmergencyContactRepository::class));

        $service = new EmployeeService($userRepository, $addressRepository, $emergencyContactRepository);
        $service->find(200);
    }
}
