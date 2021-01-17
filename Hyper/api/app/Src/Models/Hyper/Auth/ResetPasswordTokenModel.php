<?php


namespace App\Src\Models\Hyper\Auth;

class ResetPasswordTokenModel
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $isUsed;

    /**
     * @var int
     */
    private $userId;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param  string $token
     * @return ResetPasswordTokenModel
     */
    public function setToken(string $token): ResetPasswordTokenModel
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->isUsed;
    }

    /**
     * @param  bool $isUsed
     * @return ResetPasswordTokenModel
     */
    public function setIsUsed(bool $isUsed): ResetPasswordTokenModel
    {
        $this->isUsed = $isUsed;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param  int $userId
     * @return ResetPasswordTokenModel
     */
    public function setUserId(int $userId): ResetPasswordTokenModel
    {
        $this->userId = $userId;

        return $this;
    }
}
