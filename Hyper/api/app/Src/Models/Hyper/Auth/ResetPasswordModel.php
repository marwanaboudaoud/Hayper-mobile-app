<?php


namespace App\Src\Models\Hyper\Auth;

class ResetPasswordModel
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $passwordRepeat;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param  string $token
     * @return ResetPasswordModel
     */
    public function setToken(string $token): ResetPasswordModel
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param  string $password
     * @return ResetPasswordModel
     */
    public function setPassword(string $password): ResetPasswordModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordRepeat(): string
    {
        return $this->passwordRepeat;
    }

    /**
     * @param  string $passwordRepeat
     * @return ResetPasswordModel
     */
    public function setPasswordRepeat(string $passwordRepeat): ResetPasswordModel
    {
        $this->passwordRepeat = $passwordRepeat;
        return $this;
    }
}
