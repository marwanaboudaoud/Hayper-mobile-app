<?php


namespace App\Src\Services\Hyper\Notify;

use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;

interface IAuthForgotPasswordNotifyService
{
    /**
     * @param  ResetPasswordTokenModel $apiTokenModel
     * @return IAuthForgotPasswordNotifyService
     */
    public function setToken(ResetPasswordTokenModel $apiTokenModel);

    /**
     * @param string $host
     * @return IAuthForgotPasswordNotifyService
     */
    public function host(string $host);
}
