<?php


namespace App\Src\Services\Hyper\Token;

use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;

abstract class TokenService implements ITokenService
{
    /**
     * @var IUserRepository
     */
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  $id
     * @return UserModel
     * @throws UserNotFoundException
     */
    protected function getUser($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param  $token
     * @return ResetPasswordTokenModel
     * @throws ResetPasswordTokenNotFoundException
     */
    public function using($token)
    {
        // TODO: Implement using() method.
    }
}
