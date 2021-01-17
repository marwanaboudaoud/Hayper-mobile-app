<?php

namespace Tests\Unit\Mappers\Hyper\Token;

use App\ActivateUserToken;
use App\Src\Mappers\Hyper\Token\ActivateUserTokenEloquentMapper;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivateUserTokenEloquentMapperTest extends TestCase
{
    private $activateUserToken;

    public function setUp(): void
    {
        $this->activateUserToken = new ActivateUserToken();
        $this->activateUserToken->id = 1;
        $this->activateUserToken->token = Str::random();
        $this->activateUserToken->is_used = 1;
        $this->activateUserToken->user_id = 1;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $model = $this->activateUserToken;

        $result = ActivateUserTokenEloquentMapper::toModel($model);

        $this->assertEquals($model->id, $result->getId());
        $this->assertEquals($model->token, $result->getToken());
        $this->assertEquals($model->is_used, $result->isUsed());
        $this->assertEquals($model->user_id, $result->getUserId());
    }
}
