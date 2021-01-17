<?php


namespace App\Src\Models\Hyper\EmergencyContact;

class EmergencyContactModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string;
     */
    private $relationship;

    /**
     * @var int
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  int $id
     * @return EmergencyContactModel
     */
    public function setId(?int $id): EmergencyContactModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param  string $first_name
     * @return EmergencyContactModel
     */
    public function setFirstName(string $first_name): EmergencyContactModel
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param  string $last_name
     * @return EmergencyContactModel
     */
    public function setLastName(string $last_name): EmergencyContactModel
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param  string $phone
     * @return EmergencyContactModel
     */
    public function setPhone(string $phone): EmergencyContactModel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getRelationship(): string
    {
        return $this->relationship;
    }

    /**
     * @param  string $relationship
     * @return EmergencyContactModel
     */
    public function setRelationship(string $relationship): EmergencyContactModel
    {
        $this->relationship = $relationship;
        return $this;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param  int $user
     * @return EmergencyContactModel
     */
    public function setUser(int $user): EmergencyContactModel
    {
        $this->user = $user;
        return $this;
    }
}
