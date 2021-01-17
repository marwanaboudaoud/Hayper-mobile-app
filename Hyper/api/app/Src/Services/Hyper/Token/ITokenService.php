<?php


namespace App\Src\Services\Hyper\Token;

use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;

interface ITokenService
{
    public function generate(UserModel $userModel);

    public function using($token);
}
