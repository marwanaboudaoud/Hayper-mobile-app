<?php


namespace App\Src\Mappers\Request\Friend;

use App\Http\Requests\Friend\SignUpAFriendRequest;
use App\Src\Models\Hyper\Friend\FriendModel;

class FriendSignUpRequestMapper
{
    public static function toModel(SignUpAFriendRequest $signUpAFriendRequest)
    {
        return (new FriendModel())
            ->setName($signUpAFriendRequest->name)
            ->setPhone($signUpAFriendRequest->phone)
            ->setAge($signUpAFriendRequest->age)
            ->setLocation($signUpAFriendRequest->location)
            ->setToken($signUpAFriendRequest->header('api-key'));
    }
}
