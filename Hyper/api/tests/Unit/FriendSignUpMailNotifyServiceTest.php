<?php

namespace Tests\Unit;

use App\Exceptions\Notify\ActivateTokenModelNotSetException;
use App\Exceptions\Notify\EmailNotSetException;
use App\Mail\Employee\EmployeeStoreMailable;
use App\Mail\Friend\SignupAFriendMailable;
use App\Src\Models\Hyper\Friend\FriendModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\Mailable\EmployeeStoreMailNotifyService;
use App\Src\Services\Hyper\Notify\Mailable\FriendSignUpMailNotifyService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class FriendSignUpMailNotifyServiceTest extends TestCase
{
    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var FriendModel
     */
    private $friendModel;

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

            $mock->shouldReceive('getNmbrsId')
                ->andReturn(1);

            $mock->shouldReceive('getAlias')
                ->andReturn('rvw');

            $mock->shouldReceive('getInitials')
                ->andReturn('r');

            $mock->shouldReceive('getFirstName')
                ->andReturn('Ricky');

            $mock->shouldReceive('getInsertion')
                ->andReturn('van');

            $mock->shouldReceive('getLastname')
                ->andReturn('Waas');

            $mock->shouldReceive('getPhone')
                ->andReturn('061234567');

            $mock->shouldReceive('isHasDriversLicense')
                ->andReturn(true);

            $mock->shouldReceive('getDateOfBirth')
                ->andReturn('2019-01-01');

            $mock->shouldReceive('getCountryOfBirthId')
                ->andReturn(1);

            $mock->shouldReceive('getNationalityId')
                ->andReturn(1);

            $mock->shouldReceive('getMaritalStatusId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('2019-01-01');

            $mock->shouldReceive('getPassword')
                ->andReturn('123456');

            $mock->shouldReceive('isActive')
                ->andReturn(true);

            $mock->shouldReceive('setEmail')
                ->andReturn($mock);
        });

        $this->friendModel = m::mock(FriendModel::class, function ($mock) {
            $mock->shouldReceive('setName')
                ->andReturn($mock);

            $mock->shouldReceive('getName')
                ->andReturn("hoi");

            $mock->shouldReceive('setAge')
                ->andReturn($mock);

            $mock->shouldReceive('getAge')
                ->andReturn('18');

            $mock->shouldReceive('setPhone')
                ->andReturn($mock);

            $mock->shouldReceive('getPhone')
                ->andReturn('0612345678');

            $mock->shouldReceive('setLocation')
                ->andReturn($mock);

            $mock->shouldReceive('getLocation')
                ->andReturn("Amsterdam");

            $mock->shouldReceive('getToken')
                ->andReturn('12345a');

            $mock->shouldReceive('getUser')
                ->andReturn($this->userModel);

            $mock->shouldReceive('setUser')
                ->with($this->userModel)
                ->andReturn($mock);
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
    }

    public function testWithValidUserModel()
    {
        $service = new FriendSignUpMailNotifyService();
        $service->setFriendModel($this->friendModel);
        $service->send($this->userModel);
    }
}
