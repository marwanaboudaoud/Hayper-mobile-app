<?php


namespace App\Src\Models\Hyper\Auth;

class ForgotPasswordModel
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $host;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  string $email
     * @return ForgotPasswordModel
     */
    public function setEmail(string $email): ForgotPasswordModel
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return ForgotPasswordModel
     */
    public function setHost(string $host): ForgotPasswordModel
    {
        $this->host = $host;

        return $this;
    }
}
