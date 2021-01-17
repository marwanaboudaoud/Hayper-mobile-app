<?php


namespace App\Src\Services\Hyper\Auth;

use App\Exceptions\Auth\ResetPasswordTokenAlreadyUsedException;
use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Exceptions\Auth\UserInvalidPasswordException;
use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Exceptions\Token\TokenNotSetException;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use App\Src\Models\Hyper\Auth\LoginModel;
use App\Src\Models\Hyper\Auth\ResetPasswordModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Auth\IAuthTokenRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Notify\IAuthForgotPasswordNotifyService;
use App\Src\Services\Hyper\Token\ITokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    /**
     * @var IUserRepository
     */
    protected $userRepository;

    /**
     * @var ResetPasswordTokenService
     */
    protected $passwordTokenService;

    public function __construct(IUserRepository $userRepository, ITokenService $passwordTokenService)
    {
        $this->userRepository = $userRepository;
        $this->passwordTokenService = $passwordTokenService;
    }

    /**
     * @param LoginModel $loginModel
     * @return ApiTokenModel
     * @throws UserNotFoundException
     * @throws UserInvalidPasswordException
     * @throws UserNotActiveException
     */
    public function login(LoginModel $loginModel)
    {
        $userModel = $this->userRepository->findByEmail($loginModel->getEmail());

        $this->validateUser(
            $userModel,
            function () use ($userModel, $loginModel) {
                if (!Hash::check($loginModel->getPassword(), $userModel->getPassword())) {
                    throw new UserInvalidPasswordException();
                }
            }
        );

        $token = $this->userRepository->generateToken($userModel->getId());

        return $token;
    }

    /**
     * @param string $token
     * @return UserModel
     * @throws UserNotFoundException
     * @throws UserNotActiveException
     */
    public function checkApiToken(string $token)
    {
        $userModel = $this->userRepository->findByApiToken($token);

        $this->validateUser(
            $userModel,
            function () {
            }
        );

        return $userModel;
    }

    /**
     * @param UserModel|null $userModel
     * @param \Closure $validatePassword
     * @throws UserNotActiveException
     * @throws UserNotFoundException
     */
    protected function validateUser(?UserModel $userModel, \Closure $validatePassword)
    {
        if (!$userModel) {
            throw new UserNotFoundException();
        }

        $validatePassword();

        if (!$userModel->isActive()) {
            throw new UserNotActiveException();
        }
    }

    /**
     * @param ForgotPasswordModel $forgotPasswordModel
     * @param IAuthForgotPasswordNotifyService $notifyService
     * @return bool
     * @throws UserNotFoundException
     */
    public function forgotPassword(
        ForgotPasswordModel $forgotPasswordModel,
        IAuthForgotPasswordNotifyService $notifyService
    ) {
        $userModel = $this->userRepository->findByEmail($forgotPasswordModel->getEmail());

        if (!$userModel) {
            throw new UserNotFoundException();
        }

        $token = $this->passwordTokenService->generate($userModel);

        $notifyService->setToken($token)->host($forgotPasswordModel->getHost())->send($userModel);

        return true;
    }


    /**
     * @param ResetPasswordModel $resetPasswordModel
     * @return bool
     * @throws ResetPasswordTokenNotFoundException
     * @throws ResetPasswordTokenAlreadyUsedException
     */
    public function resetPassword(ResetPasswordModel $resetPasswordModel)
    {
        $token = $this->passwordTokenService->using($resetPasswordModel->getToken());

        $this->userRepository->updatePassword($token->getUserId(), $resetPasswordModel->getPassword());

        return true;
    }

    /**
     * @return array|string|null
     * @throws TokenNotSetException
     */
    public function getToken()
    {
        $token = request()->header('api-key');

        if (!$token) {
            throw new TokenNotSetException();
        }

        return $token;
    }

    public function checkRole(string $token, array $roles)
    {
        $user = $this->checkApiToken($token);

        if ($user && in_array($user->getRoleId(), $roles)) {
            return true;
        }

        return false;
    }
}
