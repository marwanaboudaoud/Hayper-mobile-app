<?php


namespace App\Src\Mappers\Request\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Src\Models\Hyper\Auth\LoginModel;

class LoginRequestMapper
{
    public static function toLoginModel(LoginRequest $loginRequest)
    {
        return (new LoginModel())
            ->setEmail($loginRequest->email)
            ->setPassword($loginRequest->password);
    }
}
