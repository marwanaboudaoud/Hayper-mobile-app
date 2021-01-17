<?php


namespace App\Src\Mappers\Hyper\Token;

use App\ActivateUserToken;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;

class ActivateUserTokenEloquentMapper
{
    /**
     * @param  ActivateUserToken $activateUser
     * @return ActivateUserTokenModel
     */
    public static function toModel(ActivateUserToken $activateUser)
    {
        return (new ActivateUserTokenModel())
            ->setUserId($activateUser->user_id)
            ->setToken($activateUser->token)
            ->setId($activateUser->id)
            ->setUsed(boolval($activateUser->is_used));
    }
}
