<?php

namespace Tests\Unit\Mappers\Request;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Src\Mappers\Request\Auth\ForgotPasswordRequestMapper;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordRequestMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $request = new ForgotPasswordRequest();
        $request->merge(['email' => 'ricky@holygrow.nl', 'host' => 'abc']);

        $result = ForgotPasswordRequestMapper::toForgotPasswordModel($request);

        $this->assertInstanceOf(ForgotPasswordModel::class, $result);
        $this->assertEquals('ricky@holygrow.nl', $result->getEmail());
    }

    public function testValidationRules()
    {
        $request = new ForgotPasswordRequest();
        $this->assertEquals(['email' => 'email|required', 'host' => 'required|url'], $request->rules());
    }
}
