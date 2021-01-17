<?php


namespace App\Src\Models\Hyper\Pagination;

class SubscriptionPaginationModel extends PaginationModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $project;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $durationInMonths;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return SubscriptionPaginationModel
     */
    public function setId(?string $id): SubscriptionPaginationModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getProject(): ?string
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return SubscriptionPaginationModel
     */
    public function setProject(?string $project): SubscriptionPaginationModel
    {
        $this->project = $project;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return SubscriptionPaginationModel
     */
    public function setCode(?string $code): SubscriptionPaginationModel
    {
        $this->code = $code;
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
     * @return SubscriptionPaginationModel
     */
    public function setTitle(?string $title): SubscriptionPaginationModel
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getDurationInMonths(): ?int
    {
        return $this->durationInMonths;
    }

    /**
     * @param int $durationInMonths
     * @return SubscriptionPaginationModel
     */
    public function setDurationInMonths(?int $durationInMonths): SubscriptionPaginationModel
    {
        $this->durationInMonths = $durationInMonths;
        return $this;
    }
}
