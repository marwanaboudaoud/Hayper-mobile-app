<?php

namespace App\Mail\Auth;

use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var UserModel
     */
    public $userModel;

    /**
     * @var ResetPasswordTokenModel
     */
    public $resetPasswordModel;

    /**
     * @var string
     */
    public $url;

    /**
     * Create a new message instance.
     *
     * @param UserModel $userModel
     * @param ResetPasswordTokenModel $token
     * @param string $host
     */
    public function __construct(UserModel $userModel, ResetPasswordTokenModel $token, string $host)
    {
        $this->userModel = $userModel;
        $this->resetPasswordModel = $token;
        $this->url = $host . '/forgot/' . $this->resetPasswordModel->getToken();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailables.forgot-password');
    }
}
