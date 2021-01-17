<?php

namespace App\Mail\Friend;

use App\Src\Models\Hyper\Friend\FriendModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignupAFriendMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var FriendModel
     */
    public $friendModel;

    /**
     * Create a new message instance.
     *
     * @param FriendModel $friendModel
     */
    public function __construct(FriendModel $friendModel)
    {
        $this->friendModel = $friendModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailables.sign-up-a-friend')
            ->subject('New friend has been signed up!');
    }
}
