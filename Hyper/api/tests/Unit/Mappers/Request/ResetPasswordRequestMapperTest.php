<?php

namespace Tests\Unit\Mappers\Request;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Src\Mappers\Request\Auth\ResetPasswordRequestMapper;
use App\Src\Models\Hyper\Auth\ResetPasswordModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ResetPasswordRequestMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $request = new ResetPasswordRequest();
        $request->merge([
            'token' => 'abc',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);

        $model = ResetPasswordRequestMapper::toModel($request);

        $this->assertInstanceOf(ResetPasswordModel::class, $model);
        $this->assertEquals($model->getToken(), 'abc');
        $this->assertEquals($model->getPassword(), '123456');
        $this->assertEquals($model->getPasswordRepeat(), '123456');
    }

    public function testValidationRules()
    {
        $request = new ResetPasswordRequest();

        $this->assertEquals($request->rules(), [
            'password' => 'required|confirmed',
            'token' => 'required'
        ]);
    }
}
