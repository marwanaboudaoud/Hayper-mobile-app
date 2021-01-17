<?php


namespace App\Src\Services\Hyper\Notify\Mailable;

use App\Exceptions\Notify\ActivateTokenModelNotSetException;
use App\Exceptions\Notify\FriendModelNotSetException;
use App\Mail\Friend\SignupAFriendMailable;
use App\Src\Models\Hyper\Friend\FriendModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\IFriendSignUpNotifyService;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class FriendSignUpMailNotifyService extends MailNotifyService implements IFriendSignUpNotifyService
{
    /**
     * @var FriendModel
     */
    private $friendModel;

    /**
     * @return Mailable
     */
    public function getMailable(): Mailable
    {
        return $this->mailable;
    }

    /**
     * @param FriendModel $friendModel
     * @return FriendSignUpMailNotifyService
     */
    public function setFriendModel(FriendModel $friendModel): FriendSignUpMailNotifyService
    {
        $this->friendModel = $friendModel;

        return $this;
    }

    public function send(UserModel $userModel)
    {
        if (!$this->friendModel) {
            throw new FriendModelNotSetException();
        }

        $userModel->setEmail(env('JOB_APPLICATION_EMAIL'));

        $this->setMailable(new SignupAFriendMailable($this->friendModel));

        parent::send($userModel);
    }
}
