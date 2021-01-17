<?php

namespace Tests\Unit\Mappers\Request;

use App\Http\Requests\Employee\EmployeeActivateRequest;
use App\Src\Mappers\Request\Employee\EmployeeActivateRequestMapper;
use App\Src\Models\Hyper\Employee\EmployeeActivateModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeActivateRequestMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $request = new EmployeeActivateRequest();
        $request->merge([
            'token' => 'token',
            'password' => '123456',
            'password_confirmation' => '1234567'
        ]);

        $map = EmployeeActivateRequestMapper::toModel($request);

        $this->assertInstanceOf(EmployeeActivateModel::class, $map);
        $this->assertEquals('token', $map->getToken());
        $this->assertEquals('123456', $map->getPassword());
        $this->assertEquals('1234567', $map->getPasswordRepeat());
    }
}
