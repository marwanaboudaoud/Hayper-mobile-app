<?php

namespace Tests\Unit;

use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Auth\IPasswordTokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use App\Src\Services\Hyper\Notify\IAuthForgotPasswordNotifyService;
use App\Src\Services\Hyper\Notify\Mailable\AuthForgotPasswordMailNotifyService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Mockery as m;

class AuthServiceForgotPasswordTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \App\Exceptions\Auth\UserInvalidPasswordException
     * @throws \App\Exceptions\Auth\UserNotActiveException
     * @throws \App\Exceptions\Auth\UserNotFoundException
     */
    public function testValidEmailForgotPassword()
    {
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function($mock) {
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
        }));
        $passwordTokenService = $this->instance(IPasswordTokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) {
            $mock->shouldReceive('generate')
                ->with(UserModel::class)
                ->andReturn(
                    m::mock(ResetPasswordTokenModel::class, function ($mock) {
                        $mock->shouldReceive('getToken')
                            ->andReturn('asbcefafsdasfdsafdasgdsdasf');

                        $mock->shouldReceive('getHost')
                            ->andReturn('abc');
                    })
                );
        }));
        $forgotPasswordModel = m::mock(ForgotPasswordModel::class, function ($mock) {
            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getHost')
                ->andReturn('abc');
        });
        $notifyService = $this->instance(IAuthForgotPasswordNotifyService::class, m::mock(AuthForgotPasswordMailNotifyService::class, function ($mock) {
            $mock->shouldReceive('setToken')
                ->with(ResetPasswordTokenModel::class)
                ->andReturn(
                    $mock
                );

            $mock->shouldReceive('host')
                ->with('abc')
                ->andReturn(
                    $mock
                );

            $mock->shouldReceive('send')
                ->with(UserModel::class)
                ->andReturn(
                    $mock
                );
        }));

        $service = new AuthService($userRepository, $passwordTokenService);
        $result = $service->forgotPassword($forgotPasswordModel, $notifyService);

        $this->assertTrue($result);
    }

    public function testInvalidEmailForgotPassword()
    {
        $this->expectException(UserNotFoundException::class);

        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function($mock) {
            $mock->shouldReceive('findByEmail')
                ->with('ricky@holygrow.nl')
                ->andReturn(
                    null
                );
        }));
        $passwordTokenService = $this->instance(IPasswordTokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) { }));
        $forgotPasswordModel = m::mock(ForgotPasswordModel::class, function ($mock) {
            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getHost')
                ->andReturn('abc');
        });
        $notifyService = $this->instance(IAuthForgotPasswordNotifyService::class, m::mock(AuthForgotPasswordMailNotifyService::class, function ($mock) {
            $mock->shouldReceive('setToken')
                ->with(ResetPasswordTokenModel::class)
                ->andReturn(
                    $mock
                );

            $mock->shouldReceive('send')
                ->with(UserModel::class)
                ->andReturn(
                    $mock
                );
        }));

        $service = new AuthService($userRepository, $passwordTokenService);
        $result = $service->forgotPassword($forgotPasswordModel, $notifyService);

        $this->assertTrue($result);
    }
}
