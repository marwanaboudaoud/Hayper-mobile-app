<?php


namespace App\Src\Models\Hyper\Token;

class ActivateUserTokenModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var bool
     */
    private $used;

    /**
     * @var string
     */
    private $userId;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  int $id
     * @return ActivateUserTokenModel
     */
    public function setId(?int $id): ActivateUserTokenModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param  string $token
     * @return ActivateUserTokenModel
     */
    public function setToken(?string $token): ActivateUserTokenModel
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUsed(): ?bool
    {
        return $this->used;
    }

    /**
     * @param  bool $used
     * @return ActivateUserTokenModel
     */
    public function setUsed(?bool $used): ActivateUserTokenModel
    {
        $this->used = $used;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param  string $userId
     * @return ActivateUserTokenModel
     */
    public function setUserId(?string $userId): ActivateUserTokenModel
    {
        $this->userId = $userId;
        return $this;
    }
}
