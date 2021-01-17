<?php


namespace App\Src\Models\Hyper\Auth;

class LoginModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  int|null $id
     * @return $this
     */
    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param  string $email
     * @return LoginModel
     */
    public function setEmail(?string $email): LoginModel
    {
        $this->email = $email;
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
     * @return LoginModel
     */
    public function setPassword(string $password): LoginModel
    {
        $this->password = $password;

        return $this;
    }
}
