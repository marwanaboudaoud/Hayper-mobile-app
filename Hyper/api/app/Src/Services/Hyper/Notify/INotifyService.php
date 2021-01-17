<?php


namespace App\Src\Services\Hyper\Notify;

use App\Src\Models\Hyper\User\UserModel;

interface INotifyService
{
    public function send(UserModel $userModel);
}
