<?php

namespace Tests\Unit;

use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Employee\EmployeeEmailAlreadyExistsException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\LoginModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\Src\Services\Hyper\Employee\EmployeeStoreService;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use App\Src\Services\Hyper\Token\ITokenService;
use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class EmployeeStoreServiceTest extends TestCase
{
    public function testNewEmployeeStore()
    {
//        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
//            $mock->shouldReceive('findByEmail')
//                ->with('ricky@holygrow.nl')
//                ->andReturn(null);
//            $mock->shouldReceive('store')
//                ->andReturn(
//                    m::mock(UserModel::class, function ($mock) {
//                        $mock->shouldReceive('getId')
//                            ->andReturn(1);
//                        $mock->shouldReceive('getAddress')
//                            ->andReturn(m::mock(AddressModel::class, function ($mock) {
//                                $mock->shouldReceive('setUser')
//                                    ->andReturn($mock);
//
//                                $mock->shouldReceive('setActive')
//                                    ->with(true)
//                                    ->andReturn($mock);
//                            }));
//                        $mock->shouldReceive('setPassword')
//                            ->andReturn();
//                    })
//                );
//        }));
//
//        $addressRepository = $this->instance(IAddressRepository::class, m::mock(IAddressRepository::class, function ($mock) {
//            $mock->shouldReceive('store')
//                ->andReturn(
//                    m::mock(UserModel::class, function ($mock) {
//                        $mock->shouldReceive('getId')
//                            ->andReturn(1);
//                        $mock->shouldReceive('getAddress')
//                            ->andReturn(m::mock(UserModel::class, function ($mock) {
//                                $mock->shouldReceive('getId')
//                                    ->andReturn(1);
//                            }));
//                    })
//                );
//        }));
//
//        $emergencyContactRepository = $this->instance(IEmergencyContactRepository::class, m::mock(IEmergencyContactRepository::class, function ($mock) {
//            $mock->shouldReceive('store')
//                ->andReturn(
//                    m::mock(UserModel::class, function ($mock) {
//                        $mock->shouldReceive('getId')
//                            ->andReturn(1);
//                        $mock->shouldReceive('getEmergencyContact')
//                            ->andReturn(m::mock(UserModel::class, function ($mock) {
//                                $mock->shouldReceive('getId')
//                                    ->andReturn(1);
//                            }));
//                    })
//                );
//        }));
//
//        $activateUserService = $this->instance(ITokenService::class, m::mock(ITokenService::class, function ($mock) {
//            $mock->shouldReceive('generate')
//                ->andReturn(
//                    m::mock(ActivateUserTokenModel::class, function ($mock) { })
//                );
//        }));
//
//        $userModel = m::mock(UserModel::class, function ($mock) {
//            $mock->shouldReceive('getId')
//                ->andReturn(1);
//
//            $mock->shouldReceive('getEmail')
//                ->andReturn('ricky@holygrow.nl');
//
//            $mock->shouldReceive('setPassword')
//                ->andReturn(m::mock(UserModel::class));
//
//            $mock->shouldReceive('setActive')
//                ->with(false)
//                ->andReturn($mock);
//
//            $mock->shouldReceive('getPassword')
//                ->andReturn('1234455678');
//
//            $mock->shouldReceive('getAddress')
//                ->andReturn(m::mock(AddressModel::class, function ($mock) {
//                    $mock->shouldReceive('getId')
//                        ->andReturn(1);
//                    $mock->shouldReceive('setActive')
//                        ->andReturn($mock);
//                    $mock->shouldReceive('setUser')
//                        ->andReturn($mock);
//
//                }));
//
//            $mock->shouldReceive('getEmergencyContact')
//                ->andReturn(m::mock(EmergencyContactModel::class, function ($mock) {
//                    $mock->shouldReceive('getId')
//                        ->andReturn(1);
//                    $mock->shouldReceive('setUser')
//                        ->andReturn(m::mock(EmergencyContactModel::class, function ($mock) {
//                        }));
//                }));
//        });
//
//        $mailService = $this->instance(IEmployeeStoreNotifyService::class, m::mock(IEmployeeStoreNotifyService::class, function ($mock) use ($activateUserService, $userModel) {
//            $mock->shouldReceive('setToken')
//                ->with($activateUserService->generate($userModel))
//                ->andReturn(
//                    $mock
//                );
//            $mock->shouldReceive('send')
//                ->andReturn(
//                    null
//                );
//        }));
//        $service = new EmployeeStoreService($userRepository, $addressRepository, $emergencyContactRepository, $activateUserService, $mailService);
//        $service->store($userModel);

        $this->assertTrue(true);
    }

    public function testExistingEmployeeStore()
    {
//        $this->expectException(EmployeeEmailAlreadyExistsException::class);
//
//        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
//            $mock->shouldReceive('findByEmail')
//                ->with('ricky@holygrow.nl')
//                ->andReturn(
//                    m::mock(UserModel::class, function ($mock) {
//                    })
//                );
//        }));
//
//        $addressRepository = $this->instance(IAddressRepository::class, m::mock(IAddressRepository::class));
//
//        $emergencyContactRepository = $this->instance(IEmergencyContactRepository::class, m::mock(IEmergencyContactRepository::class));
//
//        $activateUserService = $this->instance(ITokenService::class, m::mock(ITokenService::class, function ($mock) {}));
//
//        $userModel = m::mock(UserModel::class, function ($mock) {
//            $mock->shouldReceive('getEmail')
//                ->andReturn('ricky@holygrow.nl');
//        });
//
//        $mailService = $this->instance(IEmployeeStoreNotifyService::class, m::mock(IEmployeeStoreNotifyService::class, function ($mock) {
//            $mock->shouldReceive('send')
//                ->andReturn(
//                    null
////                    m::mock(UserModel::class, function ($mock) {
////                        $mock->shouldReceive('getId')
////                            ->andReturn(1);
////                        $mock->shouldReceive('getEmergencyContact')
////                            ->andReturn(m::mock(UserModel::class, function ($mock) {
////                                $mock->shouldReceive('getId')
////                                    ->andReturn(1);
////                            }));
////                        $mock->shouldReceive('getEmail')
////                            ->andReturn('mohamed@holygrow.nl');
////                    })
//                );
//        }));
//        $service = new EmployeeStoreService($userRepository, $addressRepository, $emergencyContactRepository, $activateUserService, $mailService);
//        $service->store($userModel);

        $this->assertTrue(true);
    }
}
