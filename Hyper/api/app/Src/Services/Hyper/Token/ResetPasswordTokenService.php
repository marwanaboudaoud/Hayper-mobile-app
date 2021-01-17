<?php


namespace App\Src\Services\Hyper\Token;

use App\Exceptions\Auth\ResetPasswordTokenAlreadyUsedException;
use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Token\ITokenRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;

class ResetPasswordTokenService extends TokenService implements IResetPasswordTokenService
{
    /**
     * @var ITokenRepository
     */
    private $passwordTokenRepository;

    /**
     * ResetPasswordTokenService constructor.
     *
     * @param ITokenRepository $passwordTokenRepository
     * @param IUserRepository  $userRepository
     */
    public function __construct(ITokenRepository $passwordTokenRepository, IUserRepository $userRepository)
    {
        $this->passwordTokenRepository = $passwordTokenRepository;

        parent::__construct($userRepository);
    }

    /**
     * @param  UserModel $userModel
     * @return ResetPasswordTokenModel
     * @throws UserNotFoundException
     */
    public function generate(UserModel $userModel)
    {
        $userModel = $this->getUser($userModel->getId());

        return $this->passwordTokenRepository->generate($userModel);
    }

    /**
     * @param  $token
     * @return ResetPasswordTokenModel
     * @throws ResetPasswordTokenNotFoundException
     * @throws ResetPasswordTokenAlreadyUsedException
     */
    public function using($token)
    {
        $token = $this->passwordTokenRepository->findByToken($token);

        if (!$token) {
            throw new ResetPasswordTokenNotFoundException();
        }

        if ($token->isUsed()) {
            throw new ResetPasswordTokenAlreadyUsedException();
        }


        return $this->passwordTokenRepository->used($token->getToken());
    }
}
