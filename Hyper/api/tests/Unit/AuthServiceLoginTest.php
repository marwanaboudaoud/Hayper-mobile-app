<?php

namespace Tests\Unit;

use App\Exceptions\Auth\UserInvalidPasswordException;
use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\LoginModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Token\ITokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Mockery as m;

class AuthServiceLoginTest extends TestCase
{
    public function testValidLogin()
    {
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByEmail')
                ->with('ricky@holygrow.nl')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);

                        $mock->shouldReceive('getPassword')
                            ->andReturn(
                                Hash::make('123456')
                            );

                        $mock->shouldReceive('isActive')
                            ->andReturn(
                                true
                            );
                    })
                );

            $mock->shouldReceive('generateToken')
                ->andReturn(
                    m::mock(ApiTokenModel::class, function ($mock) {
                        $mock->shouldReceive('getToken')
                            ->andReturn('123456');
                    })
                );
        }));
        $passwordTokenService = $this->instance(ITokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));
        $loginModel = m::mock(LoginModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getPassword')
                ->andReturn('123456');
        });

        $service = new AuthService($userRepository, $passwordTokenService);
        $result = $service->login($loginModel);

        $this->assertInstanceOf(ApiTokenModel::class, $result);
    }

    public function testInactiveLogin()
    {
        $this->expectException(UserNotActiveException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByEmail')
                ->with('ricky@holygrow.nl')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);

                        $mock->shouldReceive('getPassword')
                            ->andReturn(
                                Hash::make('123456')
                            );

                        $mock->shouldReceive('isActive')
                            ->andReturn(
                                false
                            );
                    })
                );

            $mock->shouldReceive('generateToken')
                ->andReturn(
                    m::mock(ApiTokenModel::class, function ($mock) {
                        $mock->shouldReceive('getToken')
                            ->andReturn('123456');
                    })
                );
        }));
        $passwordTokenService = $this->instance(ITokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));

        $loginModel = m::mock(LoginModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getPassword')
                ->andReturn('123456');
        });

        $service = new AuthService($userRepository, $passwordTokenService);
        $service->login($loginModel);
    }

    public function testInvalidEmailLogin()
    {
        $this->expectException(UserNotFoundException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByEmail')
                ->with('ricky@holygrow.nl')
                ->andReturn(null);
        }));
        $passwordTokenService = $this->instance(ITokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));

        $loginModel = m::mock(LoginModel::class, function ($mock) {
            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');
        });

        $service = new AuthService($userRepository, $passwordTokenService);
        $service->login($loginModel);
    }

    public function testInvalidPassword()
    {
        $this->expectException(UserInvalidPasswordException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByEmail')
                ->with('ricky@holygrow.nl')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) {
                        $mock->shouldReceive('getPassword')
                            ->andReturn(
                                Hash::make('123456')
                            );
                    })
                );
        }));
        $passwordTokenService = $this->instance(ITokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));

        $loginModel = m::mock(LoginModel::class, function ($mock) {
            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getPassword')
                ->andReturn('12345');
        });

        $service = new AuthService($userRepository, $passwordTokenService);
        $service->login($loginModel);
    }
}
