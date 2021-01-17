<?php


namespace App\Src\Repositories\Hyper\Token;

use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;

interface ITokenRepository
{

    public function findByToken(string $token);

    public function generate(UserModel $userModel);

    public function used(string $token);
}
