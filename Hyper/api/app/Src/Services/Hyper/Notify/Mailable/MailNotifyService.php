<?php


namespace App\Src\Services\Hyper\Notify\Mailable;

use App\Exceptions\Notify\EmailNotSetException;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\INotifyService;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

abstract class MailNotifyService implements INotifyService
{
    /**
     * @var Mailable
     */
    protected $mailable;

    /**
     * @param  Mailable $mailable
     * @return $this
     */
    protected function setMailable(Mailable $mailable)
    {
        $this->mailable = $mailable;

        return $this;
    }

    /**
     * @return Mailable
     */
    public function getMailable(): Mailable
    {
        return $this->mailable;
    }

    /**
     * @param  UserModel $userModel
     * @return bool
     * @throws EmailNotSetException
     */
    public function send(UserModel $userModel)
    {
        if (!$userModel->getEmail()) {
            throw new EmailNotSetException();
        }

        if (env('APP_ENV') !== 'testing') {
            Mail::to($userModel->getEmail())->send($this->getMailable());
        }

        return true;
    }
}
