<?php


namespace App\Src\Models\Hyper\Friend;

use App\Src\Models\Hyper\User\UserModel;

class FriendModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string;
     */
    private $age;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $location;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FriendModel
     */
    public function setName(?string $name): FriendModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAge(): ?string
    {
        return $this->age;
    }

    /**
     * @param string $age
     * @return FriendModel
     */
    public function setAge(?string $age): FriendModel
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return FriendModel
     */
    public function setPhone(?string $phone): FriendModel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return FriendModel
     */
    public function setLocation(?string $location): FriendModel
    {
        $this->location = $location;
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
     * @param string $token
     * @return FriendModel
     */
    public function setToken(?string $token): FriendModel
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return UserModel
     */
    public function getUser(): ?UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel $user
     * @return FriendModel
     */
    public function setUser(?UserModel $user): FriendModel
    {
        $this->user = $user;
        return $this;
    }
}
