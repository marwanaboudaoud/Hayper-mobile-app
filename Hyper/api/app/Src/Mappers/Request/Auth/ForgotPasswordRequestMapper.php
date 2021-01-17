<?php


namespace App\Src\Mappers\Request\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;

class ForgotPasswordRequestMapper
{
    public static function toForgotPasswordModel(ForgotPasswordRequest $request)
    {
        return (new ForgotPasswordModel())
            ->setEmail($request->email)
            ->setHost($request->host);
    }
}
