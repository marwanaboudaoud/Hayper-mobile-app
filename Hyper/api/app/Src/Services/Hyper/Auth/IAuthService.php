<?php


namespace App\Src\Services\Hyper\Auth;

use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use App\Src\Models\Hyper\Auth\LoginModel;
use App\Src\Models\Hyper\Auth\ResetPasswordModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\IAuthForgotPasswordNotifyService;
use App\Src\Services\Hyper\Notify\INotifyService;

interface IAuthService
{
    /**
     * @param  LoginModel $loginModel
     * @return ApiTokenModel
     */
    public function login(LoginModel $loginModel);

    /**
     * @param string $token
     * @return UserModel
     */
    public function checkApiToken(string $token);

    /**
     * @param ForgotPasswordModel $forgotPasswordModel
     * @param IAuthForgotPasswordNotifyService $notifyService
     * @return bool
     * @throws UserNotFoundException
     */
    public function forgotPassword(
        ForgotPasswordModel $forgotPasswordModel,
        IAuthForgotPasswordNotifyService $notifyService
    );

    /**
     * @param ResetPasswordModel $resetPasswordModel
     * @return boolean
     */
    public function resetPassword(ResetPasswordModel $resetPasswordModel);

    /**
     * @return string
     */
    public function getToken();

    public function checkRole(string $token, array $roles);
}
