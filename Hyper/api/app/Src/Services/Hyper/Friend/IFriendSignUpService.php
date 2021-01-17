<?php


namespace App\Src\Services\Hyper\Friend;

use App\Src\Models\Hyper\Friend\FriendModel;

interface IFriendSignUpService
{
    public function signUp(FriendModel $friendModel);
}
