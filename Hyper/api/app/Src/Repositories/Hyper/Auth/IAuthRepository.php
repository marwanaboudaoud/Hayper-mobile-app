<?php


namespace App\Src\Repositories\Hyper\Auth;

use App\Src\Models\Hyper\Auth\JwtModel;
use App\Src\Models\Hyper\Auth\LoginModel;

interface IAuthRepository
{
    /**
     * @param  LoginModel $loginModel
     * @return JwtModel
     */
    public function login(LoginModel $loginModel);
}
