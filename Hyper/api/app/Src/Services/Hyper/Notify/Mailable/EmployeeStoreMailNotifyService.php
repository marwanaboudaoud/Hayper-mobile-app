<?php


namespace App\Src\Services\Hyper\Notify\Mailable;

use App\Exceptions\Notify\ActivateTokenModelNotSetException;
use App\Exceptions\Notify\EmailNotSetException;
use App\Mail\Employee\EmployeeStoreMailable;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\IAuthForgotPasswordNotifyService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;

class EmployeeStoreMailNotifyService extends MailNotifyService implements IEmployeeStoreNotifyService
{
    /**
     * @var ActivateUserTokenModel
     */
    private $tokenModel;

    /**
     * @param  ActivateUserTokenModel $tokenModel
     * @return EmployeeStoreMailNotifyService
     */
    public function setToken(ActivateUserTokenModel $tokenModel)
    {
        $this->tokenModel = $tokenModel;

        return $this;
    }

    /**
     * @param  UserModel $userModel
     * @return bool
     * @throws ActivateTokenModelNotSetException
     * @throws EmailNotSetException
     */
    public function send(UserModel $userModel)
    {
        $tokenModel = $this->tokenModel;

        if (!$tokenModel) {
            throw new ActivateTokenModelNotSetException();
        }

        $this->setMailable(new EmployeeStoreMailable($userModel, $this->tokenModel));

        return parent::send($userModel);
    }
}
