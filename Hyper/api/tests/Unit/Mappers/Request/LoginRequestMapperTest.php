<?php

namespace Tests\Unit\Mappers\Request;

use App\Http\Requests\Auth\LoginRequest;
use App\Src\Mappers\Request\Auth\LoginRequestMapper;
use App\Src\Models\Hyper\Auth\LoginModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginRequestMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $loginRequest = new LoginRequest();
        $loginRequest->merge([
            'email' => 'ricky@holygrow.nl',
            'password' => '123456'
        ]);

        $model = LoginRequestMapper::toLoginModel($loginRequest);

        $this->assertInstanceOf(LoginModel::class, $model);
        $this->assertEquals($model->getEmail(), 'ricky@holygrow.nl');
        $this->assertEquals($model->getPassword(), '123456');
    }

    public function testValidationRules()
    {
        $loginRequest = new LoginRequest();
        $this->assertEquals($loginRequest->rules(), [
            'email' => 'email|required',
            'password' => 'string|required'
        ]);
    }
}
