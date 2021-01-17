<?php

namespace Tests\Unit\Mappers\Hyper\Auth;

use App\ForgotPasswordToken;
use App\Src\Mappers\Hyper\Auth\PasswordTokenEloquentModelMapper;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class PasswordTokenEloquentModelMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testModel()
    {
        $forgotPasswordToken = new ForgotPasswordToken();
        $forgotPasswordToken->token = 'abcdef';
        $forgotPasswordToken->is_used = 1;
        $forgotPasswordToken->user_id = 2;

        $result = PasswordTokenEloquentModelMapper::toModel($forgotPasswordToken);
        $this->assertInstanceOf(ResetPasswordTokenModel::class, $result);
        $this->assertEquals('abcdef', $result->getToken());
        $this->assertEquals(true, $result->isUsed());
        $this->assertEquals(2, $result->getUserId());
    }
}
