<?php


namespace App\Src\Models\Hyper\Declaration;

use App\Http\Requests\Declaration\DeclarationUploadRequest;
use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;
use http\Client\Request;

class DeclarationModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $declaration_type;

    /**
     * @var Carbon
     */
    private $date_of_submission;

    /**
     * @var string
     */
    private $location;

    /**
     * @var double
     */
    private $amount_exc_vat;

    /**
     * @var int
     */
    private $vat;

    /**
     * @var DeclarationUploadRequest
     */
    private $image;

    /**
     * @var string
     */
    private $token;

    /**
     * @var UserModel
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DeclarationModel
     */
    public function setId(int $id): DeclarationModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeclarationType(): ?string
    {
        return $this->declaration_type;
    }

    /**
     * @param string $declaration_type
     * @return DeclarationModel
     */
    public function setDeclarationType(?string $declaration_type): DeclarationModel
    {
        $this->declaration_type = $declaration_type;
        return $this;
    }



    /**
     * @return Carbon
     */
    public function getDateOfSubmission(): Carbon
    {
        return $this->date_of_submission;
    }

    /**
     * @param Carbon $date_of_submission
     * @return DeclarationModel
     */
    public function setDateOfSubmission(Carbon $date_of_submission): DeclarationModel
    {
        $this->date_of_submission = $date_of_submission;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return DeclarationModel
     */
    public function setLocation(string $location): DeclarationModel
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountExcVat(): float
    {
        return $this->amount_exc_vat;
    }

    /**
     * @param float $amount_exc_vat
     * @return DeclarationModel
     */
    public function setAmountExcVat(float $amount_exc_vat): DeclarationModel
    {
        $this->amount_exc_vat = $amount_exc_vat;
        return $this;
    }

    /**
     * @return int
     */
    public function getVat(): int
    {
        return $this->vat;
    }

    /**
     * @param int $vat
     * @return DeclarationModel
     */
    public function setVat(int $vat): DeclarationModel
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return DeclarationUploadRequest
     */
    public function getImage(): DeclarationUploadRequest
    {
        return $this->image;
    }

    /**
     * @param DeclarationUploadRequest $image
     * @return DeclarationModel
     */
    public function setImage(DeclarationUploadRequest $image): DeclarationModel
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return DeclarationModel
     */
    public function setToken(string $token): DeclarationModel
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
     * @return DeclarationModel
     */
    public function setUser(?UserModel $user): ?DeclarationModel
    {
        $this->user = $user;
        return $this;
    }
}
