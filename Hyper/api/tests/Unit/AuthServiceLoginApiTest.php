<?php

namespace Tests\Unit;

use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\LoginModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Auth\IPasswordTokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use Hamcrest\Thingy;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class AuthServiceLoginApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \App\Exceptions\Auth\UserNotActiveException
     * @throws \App\Exceptions\Auth\UserNotFoundException
     */
    public function testValidLogin()
    {
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByApiToken')
                ->with('abc')
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
        }));
        $passwordTokenService = $this->instance(IPasswordTokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));

        $service = new AuthService($userRepository, $passwordTokenService);
        $result = $service->checkApiToken('abc');

        $this->assertInstanceOf(UserModel::class, $result);
    }

    public function testValidLoginWithInactiveStatus()
    {
        $this->expectException(UserNotActiveException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByApiToken')
                ->with('abc')
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
        }));
        $passwordTokenService = $this->instance(IPasswordTokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));

        $service = new AuthService($userRepository, $passwordTokenService);
        $service->checkApiToken('abc');
    }

    public function testInvalidLogin()
    {
        $this->expectException(UserNotFoundException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findByApiToken')
                ->with('abc')
                ->andReturn(
                    null
                );
        }));
        $passwordTokenService = $this->instance(IPasswordTokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));

        $service = new AuthService($userRepository, $passwordTokenService);
        $service->checkApiToken('abc');
    }
}
