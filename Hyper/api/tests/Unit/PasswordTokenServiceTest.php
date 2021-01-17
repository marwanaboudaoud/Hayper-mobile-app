<?php

namespace Tests\Unit;

use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Token\ITokenRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class PasswordTokenServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGenerateWithValidModel()
    {
        $passwordRepository = $this->instance(ITokenRepository::class, m::mock(ITokenRepository::class, function($mock) {
            $mock->shouldReceive('generate')
                ->with(UserModel::class)
                ->andReturn(
                    m::mock(ResetPasswordTokenModel::class, function ($mock) {})
                );
        }));
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
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
        $userModel = $this->instance(UserModel::class, m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(
                    1
                );
        }));

        $passwordTokenService = new ResetPasswordTokenService($passwordRepository, $userRepository);
        $resetPasswordModel = $passwordTokenService->generate($userModel);

        $this->assertInstanceOf(ResetPasswordTokenModel::class, $resetPasswordModel);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGenerateWithInvalidModel()
    {
        $this->expectException(UserNotFoundException::class);

        $passwordRepository = $this->instance(ITokenRepository::class, m::mock(ITokenRepository::class, function($mock) {
            $mock->shouldReceive('generate')
                ->with(UserModel::class)
                ->andReturn(
                    m::mock(ResetPasswordTokenModel::class, function ($mock) {})
                );
        }));
        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(
                    null
                );
        }));
        $userModel = $this->instance(UserModel::class, m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(
                    1
                );
        }));

        $passwordTokenService = new ResetPasswordTokenService($passwordRepository, $userRepository);
        $resetPasswordModel = $passwordTokenService->generate($userModel);

        $this->assertInstanceOf(ResetPasswordTokenModel::class, $resetPasswordModel);
    }
}
