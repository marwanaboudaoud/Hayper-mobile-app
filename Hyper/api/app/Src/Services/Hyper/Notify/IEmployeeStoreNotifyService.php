<?php


namespace App\Src\Services\Hyper\Notify;

use App\Src\Models\Hyper\Token\ActivateUserTokenModel;

interface IEmployeeStoreNotifyService extends INotifyService
{
    /**
     * @param  ActivateUserTokenModel $apiTokenModel
     * @return IAuthForgotPasswordNotifyService
     */
    public function setToken(ActivateUserTokenModel $apiTokenModel);
}
