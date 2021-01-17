<?php


namespace App\Src\Models\Hyper\AvailabilityShift;

class AvailabilityShiftModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AvailabilityShiftModel
     */
    public function setId(?int $id): AvailabilityShiftModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AvailabilityShiftModel
     */
    public function setName(?string $name): AvailabilityShiftModel
    {
        $this->name = $name;
        return $this;
    }
}
