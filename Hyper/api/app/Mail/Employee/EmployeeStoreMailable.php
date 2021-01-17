<?php

namespace App\Mail\Employee;

use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeeStoreMailable extends Mailable
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
     * Create a new message instance.
     *
     * @param UserModel              $userModel
     * @param ActivateUserTokenModel $token
     */
    public function __construct(UserModel $userModel, ActivateUserTokenModel $token)
    {
        $this->userModel = $userModel;
        $this->resetPasswordModel = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailables.activate-employee');
    }
}
