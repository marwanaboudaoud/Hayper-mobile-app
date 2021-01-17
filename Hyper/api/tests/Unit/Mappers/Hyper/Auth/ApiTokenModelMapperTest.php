<?php

namespace Tests\Unit\Mappers\Hyper\Auth;

use App\Src\Mappers\Hyper\Auth\ApiTokenModelMapper;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ApiTokenModelMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToArray()
    {
        $apiTokenModel = m::mock(ApiTokenModel::class, function ($mock) {
            $mock->shouldReceive('getToken')
                ->andReturn('abcdefg');

            $mock->shouldReceive('getUser')
                ->andReturn((new UserModel()));
        });

        $result = ApiTokenModelMapper::toArray($apiTokenModel);

        $this->assertEquals([
            'token' => 'abcdefg',
            'user' => [
                'id' => null,
                'alias' => null,
                'nmbrs_id' => null,
                'initials' => null,
                'first_name' => null,
                'insertion' => null,
                'last_name' => null,
                'phone' => null,
                'address' => [],
                'emergency_contact' => [],
                'contract' => [],
                'has_drivers_license' => null,
                'date_of_birth' => null,
                'country_of_birth_id' => null,
                'nationality_id' => null,
                'marital_status_id' => null,
                'email' => null,
                'gender_id' => null,
                'role' => [],
                'role_title' => null,
                'location' => null,
                'into_service' => null,
                'out_of_service' => null,
                'is_active' => null,
                'iban' => null,
                'income_tax' => null
            ]
        ], $result);
    }
}
