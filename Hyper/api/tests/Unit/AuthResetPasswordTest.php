<?php

namespace Tests\Unit;

use App\Exceptions\Auth\ResetPasswordTokenAlreadyUsedException;
use App\Exceptions\Auth\UserNotActiveException;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ResetPasswordModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Auth\IPasswordTokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class AuthResetPasswordTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testValidWithValidToken()
    {
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function($mock) {
            $mock->shouldReceive('updatePassword')
                ->andReturn(
                    m::mock(UserModel::class, function ($mock) { })
                );
        }));
        $passwordTokenService = $this->instance(IPasswordTokenService::class, m::mock(ResetPasswordTokenService::class, function ($mock) {
            $mock->shouldReceive('using')
                ->with('abc')
                ->andReturn(
                    m::mock(ResetPasswordTokenModel::class, function ($mock) {
                        $mock->shouldReceive('isUsed')
                            ->andReturn(false);

                        $mock->shouldReceive('getUserId')
                            ->andReturn(1);
                    })
                );
        }));

        $resetPasswordModel = m::mock(ResetPasswordModel::class, function ($mock) {
            $mock->shouldReceive('getToken')
                ->andReturn('abc');

            $mock->shouldReceive('getPassword')
                ->andReturn('12345');
        });

        $service = new AuthService($userRepository, $passwordTokenService);
        $result = $service->resetPassword($resetPasswordModel);

        $this->assertTrue($result);
    }
}
