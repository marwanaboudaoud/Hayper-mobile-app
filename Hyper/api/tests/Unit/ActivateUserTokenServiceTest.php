<?php

namespace Tests\Unit;

use App\Exceptions\ActivateToken\ActivateTokenNotFoundException;
use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Exceptions\Employee\ActivateTokenAlreadyUsedException;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Token\ITokenRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Token\ActivateUserTokenService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ActivateUserTokenServiceTest extends TestCase
{
    /**
     * @var ActivateUserTokenService
     */
    private $activateUserTokenService;

    /**
     * @var ITokenRepository
     */
    private $tokenRepository;

    /**
     * @var ITokenRepository
     */
    private $tokenNotFoundRepository;

    /**
     * @var ITokenRepository|m\LegacyMockInterface|m\MockInterface
     */
    private $tokenAlreadyUsedRepository;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    public function setUp(): void
    {
        $this->tokenRepository = m::mock(ITokenRepository::class, function ($mock) {
            $mock->shouldReceive('findByToken')
                ->with('123')
                ->andReturn(
                    m::mock(ITokenRepository::class, function ($mock) {
                        $mock->shouldReceive('isUsed')
                            ->andReturn(false);

                        $mock->shouldReceive('getToken')
                            ->andReturn('123');
                    })
                );

            $mock->shouldReceive('used')
                ->with('123')
                ->andReturn(true);
        });
        $this->tokenNotFoundRepository = m::mock(ITokenRepository::class, function ($mock) {
            $mock->shouldReceive('findByToken')
                ->with('123')
                ->andReturn(null);
        });
        $this->tokenAlreadyUsedRepository = m::mock(ITokenRepository::class, function ($mock) {
            $mock->shouldReceive('findByToken')
                ->with('123')
                ->andReturn(
                    m::mock(ITokenRepository::class, function ($mock) {
                        $mock->shouldReceive('isUsed')
                            ->andReturn(true);
                    })
                );
        });
        $this->userRepository = m::mock(IUserRepository::class, function ($mock) { });

        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws ActivateTokenNotFoundException
     * @throws ResetPasswordTokenNotFoundException
     */
    public function testUsingTokenNotFound()
    {
        $this->expectException(ActivateTokenNotFoundException::class);

        $service = new ActivateUserTokenService($this->tokenNotFoundRepository, $this->userRepository);
        $service->using('123');
    }

    public function testUsingTokenAlreadyUsed()
    {
        $this->expectException(ActivateTokenAlreadyUsedException::class);

        $service = new ActivateUserTokenService($this->tokenAlreadyUsedRepository, $this->userRepository);
        $service->using('123');
    }

    public function testUsing()
    {
        $service = new ActivateUserTokenService($this->tokenRepository, $this->userRepository);
        $service->using('123');
    }
}
