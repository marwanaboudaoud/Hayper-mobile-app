<?php

namespace Tests\Unit;

use App\Exceptions\Auth\UserNotFoundException;
use App\Exceptions\Notify\EmailNotSetException;
use App\Exceptions\Notify\ResetPasswordTokenNotSetException;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\Mailable\AuthForgotPasswordMailNotifyService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class AuthForgotPasswordNotifyServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testWithValidUserModelAndValidTokenModelExample()
    {
        $resetPasswordModel = m::mock(ResetPasswordTokenModel::class, function ($mock) {
            $mock->shouldReceive('getToken')
                ->andReturn('abcde');
        });

        $userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getName')
                ->andReturn(
                    'Ricky van Waas'
                );
        });

        $service = new AuthForgotPasswordMailNotifyService();
        $result = $service->host('abc')->setToken($resetPasswordModel)->send($userModel);


        $this->assertTrue($result);
    }

    public function testWithInvalidUserModelAndValidTokenModelExample()
    {
        $this->expectException(EmailNotSetException::class);

        $resetPasswordModel = m::mock(ResetPasswordTokenModel::class, function ($mock) {
            $mock->shouldReceive('getToken')
                ->andReturn('123456');
        });

        $userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn(null);

            $mock->shouldReceive('getName')
                ->andReturn(
                    'Ricky van Waas'
                );
        });

        $service = new AuthForgotPasswordMailNotifyService();
        $service->host('test')->setToken($resetPasswordModel)->send($userModel);
    }

    public function testWithValidUserModelAndInvalidTokenModelExample()
    {
        $this->expectException(\TypeError::class);

        $resetPasswordModel = m::mock(ResetPasswordTokenModel::class, function ($mock) {
            $mock->shouldReceive('getToken')
                ->andReturn(null);
        });

        $userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getName')
                ->andReturn(
                    'Ricky van Waas'
                );
        });

        $service = new AuthForgotPasswordMailNotifyService();
        $service->host('abc')->setToken($resetPasswordModel)->send($userModel);
    }
}
