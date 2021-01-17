<?php


namespace App\Src\Mappers\Request\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Src\Models\Hyper\Auth\ResetPasswordModel;

class ResetPasswordRequestMapper
{
    public static function toModel(ResetPasswordRequest $request)
    {
        return (new ResetPasswordModel())
            ->setToken($request->token)
            ->setPassword($request->password)
            ->setPasswordRepeat($request->password_confirmation);
    }
}
