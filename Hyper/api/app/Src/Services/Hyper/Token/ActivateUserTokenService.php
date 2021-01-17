<?php


namespace App\Src\Services\Hyper\Token;

use App\Exceptions\ActivateToken\ActivateTokenNotFoundException;
use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Exceptions\Employee\ActivateTokenAlreadyUsedException;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Token\ITokenRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;

class ActivateUserTokenService extends TokenService implements IActivateUserTokenService
{
    /**
     * @var ITokenRepository
     */
    private $activateUserRepository;

    public function __construct(ITokenRepository $activateUserRepository, IUserRepository $userRepository)
    {
        $this->activateUserRepository = $activateUserRepository;

        parent::__construct($userRepository);
    }

    /**
     * @param  UserModel $userModel
     * @return ActivateUserTokenModel
     * @throws \App\Exceptions\Auth\UserNotFoundException
     */
    public function generate(UserModel $userModel)
    {
        $userModel = $this->getUser($userModel->getId());

        return $this->activateUserRepository->generate($userModel);
    }

    /**
     * @param  $token
     * @return ActivateUserTokenModel
     * @throws ResetPasswordTokenNotFoundException
     * @throws ActivateTokenNotFoundException
     * @throws ActivateTokenAlreadyUsedException
     */
    public function using($token)
    {
        $token = $this->activateUserRepository->findByToken($token);

        if (!$token) {
            throw new ActivateTokenNotFoundException();
        }

        if ($token->isUsed()) {
            throw new ActivateTokenAlreadyUsedException();
        }

        return $this->activateUserRepository->used($token->getToken());
    }
}
