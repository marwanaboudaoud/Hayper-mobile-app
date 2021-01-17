<?php


namespace App\Src\Models\Hyper\Employee;

class EmployeeActivateModel
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
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param  string $token
     * @return EmployeeActivateModel
     */
    public function setToken(?string $token): EmployeeActivateModel
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param  string $password
     * @return EmployeeActivateModel
     */
    public function setPassword(?string $password): EmployeeActivateModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordRepeat(): ?string
    {
        return $this->passwordRepeat;
    }

    /**
     * @param  string $passwordRepeat
     * @return EmployeeActivateModel
     */
    public function setPasswordRepeat(?string $passwordRepeat): EmployeeActivateModel
    {
        $this->passwordRepeat = $passwordRepeat;
        return $this;
    }
}
