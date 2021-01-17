<?php


namespace App\Src\Services\Hyper\Notify\Mailable;

use App\Exceptions\Notify\EmailNotSetException;
use App\Exceptions\Notify\ResetPasswordTokenNotSetException;
use App\Mail\Auth\ForgotPasswordMailable;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ResetPasswordModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\IAuthForgotPasswordNotifyService;
use App\Src\Services\Hyper\Notify\INotifyService;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class AuthForgotPasswordMailNotifyService extends MailNotifyService implements IAuthForgotPasswordNotifyService
{
    /**
     * @var ResetPasswordTokenModel
     */
    protected $token;

    /**
     * @var string
     */
    protected $host;

    /**
     * @param  ResetPasswordTokenModel $resetPasswordTokenModel
     * @return IAuthForgotPasswordNotifyService
     */
    public function setToken(ResetPasswordTokenModel $resetPasswordTokenModel)
    {
        $this->token = $resetPasswordTokenModel;

        return $this;
    }

    /**
     * @param string $host
     * @return $this|IAuthForgotPasswordNotifyService
     */
    public function host(string $host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param  UserModel $userModel
     * @return bool
     * @throws EmailNotSetException
     * @throws ResetPasswordTokenNotSetException
     */
    public function send(UserModel $userModel)
    {
        if (!$this->token->getToken()) {
            throw new ResetPasswordTokenNotSetException();
        }

        $this->setMailable(new ForgotPasswordMailable($userModel, $this->token, $this->host));

        return parent::send($userModel);
    }
}
