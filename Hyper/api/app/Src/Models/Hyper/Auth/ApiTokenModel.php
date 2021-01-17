<?php


namespace App\Src\Models\Hyper\Auth;

use App\Src\Models\Hyper\User\UserModel;

class ApiTokenModel
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var UserModel
     */
    private $user;

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param  string $token
     * @return ApiTokenModel
     */
    public function setToken(?string $token): ApiTokenModel
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return UserModel
     */
    public function getUser(): UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel $user
     * @return ApiTokenModel
     */
    public function setUser(UserModel $user): ApiTokenModel
    {
        $this->user = $user;

        return $this;
    }
}
