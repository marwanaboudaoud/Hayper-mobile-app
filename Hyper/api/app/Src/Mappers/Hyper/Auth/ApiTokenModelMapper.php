<?php


namespace App\Src\Mappers\Hyper\Auth;

use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Auth\ApiTokenModel;

class ApiTokenModelMapper
{
    public static function toArray(ApiTokenModel $apiTokenModel)
    {
        return [
            'token' => $apiTokenModel->getToken(),
            'user' => UserModelMapper::toArray($apiTokenModel->getUser())
        ];
    }
}
