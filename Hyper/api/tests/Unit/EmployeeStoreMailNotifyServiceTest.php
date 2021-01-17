<?php

namespace Tests\Unit;

use App\Exceptions\Notify\ActivateTokenModelNotSetException;
use App\Exceptions\Notify\EmailNotSetException;
use App\Mail\Employee\EmployeeStoreMailable;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\Mailable\EmployeeStoreMailNotifyService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class EmployeeStoreMailNotifyServiceTest extends TestCase
{
    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var
     */
    private $invalidUserModel;
    /**
     * @var ActivateUserTokenModel|m\LegacyMockInterface|m\MockInterface
     */
    private $activateTokenModel;

    public function setUp(): void
    {
        parent::setUp();

        $this->userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('ricky@holygrow.nl');

            $mock->shouldReceive('getName')
                ->andReturn(
                    'Ricky van Waas'
                );
        });
        $this->invalidUserModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn(null);

            $mock->shouldReceive('getName')
                ->andReturn(
                    'Ricky van Waas'
                );
        });
        $this->activateTokenModel = m::mock(ActivateUserTokenModel::class, function ($mock) {});
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testValidModel()
    {
        $service = new EmployeeStoreMailNotifyService();
        $service->setToken($this->activateTokenModel);
        $result = $service->send($this->userModel);

        $this->assertTrue($result);
    }

    public function testInvalidActivateTokenModel()
    {
        $this->expectException(ActivateTokenModelNotSetException::class);

        $service = new EmployeeStoreMailNotifyService();
        $service->send($this->userModel);
    }

    public function testInvalidUserModel()
    {
        $this->expectException(EmailNotSetException::class);

        $service = new EmployeeStoreMailNotifyService();
        $service->setToken($this->activateTokenModel);
        $service->send($this->invalidUserModel);
    }

    public function testValidMailableTest()
    {
        $service = new EmployeeStoreMailNotifyService();
        $service->setToken($this->activateTokenModel);
        $service->send($this->userModel);

        $this->assertInstanceOf(EmployeeStoreMailable::class, $service->getMailable());
    }
}
