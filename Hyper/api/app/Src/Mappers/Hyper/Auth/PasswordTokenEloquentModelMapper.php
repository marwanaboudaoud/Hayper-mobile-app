<?php


namespace App\Src\Mappers\Hyper\Auth;

use App\ForgotPasswordToken;

use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;

class PasswordTokenEloquentModelMapper
{
    /**
     * @param  ForgotPasswordToken $forgotPasswordModel
     * @return ResetPasswordTokenModel
     */
    public static function toModel(ForgotPasswordToken $forgotPasswordModel)
    {
        return (new ResetPasswordTokenModel())
            ->setToken($forgotPasswordModel->token)
            ->setIsUsed(boolval($forgotPasswordModel->is_used))
            ->setUserId($forgotPasswordModel->user_id);
    }
}
