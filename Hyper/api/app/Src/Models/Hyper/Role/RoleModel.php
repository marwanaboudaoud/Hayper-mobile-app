<?php


namespace App\Src\Models\Hyper\Role;

class RoleModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $code_in_nmbrs;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RoleModel
     */
    public function setId(?int $id): RoleModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return RoleModel
     */
    public function setTitle(?string $title): RoleModel
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getCodeInNmbrs(): ?int
    {
        return $this->code_in_nmbrs;
    }

    /**
     * @param int $code_in_nmbrs
     * @return RoleModel
     */
    public function setCodeInNmbrs(?int $code_in_nmbrs): RoleModel
    {
        $this->code_in_nmbrs = $code_in_nmbrs;
        return $this;
    }
}
