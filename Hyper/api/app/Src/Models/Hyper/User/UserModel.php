<?php


namespace App\Src\Models\Hyper\User;

use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\Declaration\DeclarationModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\Friend\FriendModel;
use App\Src\Models\Hyper\Role\RoleModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserModel
{
    /**
     * @var ?int
     */
    private $id;

    /**
     * @var string
     */
    private $alias;
    /**
     * @var int
     */
    private $nmbrs_id;

    /**
     * @var string
     */
    private $initials;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $insertion;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var boolean
     */
    private $has_drivers_license;

    /**
     * @var string
     */
    private $date_of_birth;

    /**
     * @var int
     */
    private $country_of_birth_id;

    /**
     * @var int
     */
    private $nationality_id;

    /**
     * @var int
     */
    private $marital_status_id;

    /**
     * @var string;
     */
    private $password;
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $email_verified_at;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var int
     */
    private $genderId;

    /**
     * @var AddressModel
     */
    private $address;

    /**
     * @var EmergencyContactModel
     */
    private $emergency_contact;

    /**
     * @var RoleModel
     */
    private $role;

    /**
     * @var int
     */
    private $roleId;

    /**
     * @var string
     */
    private $location;

    /**
     * @var Carbon
     */
    private $intoServiceDate;

    /**
     * @var int
     */
    private $bsn;

    /**
     * @var Carbon
     */
    private $endDateContract;

    /**
     * @var EmployeeContractModel
     */
    private $employeeContract;

    /**
     * @var Collection
     */
    private $workOnProject;

    /**
     * @var string
     */
    private $iban;

    /**
     * @var boolean
     */
    private $income_tax;

    /**
     * @var Carbon
     */
    private $out_of_service;

    /**
     * @var float
     */
    private $hourlyWage;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserModel
     */
    public function setId(?int $id): UserModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return UserModel
     */
    public function setAlias(?string $alias): UserModel
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return int
     */
    public function getNmbrsId(): ?int
    {
        return $this->nmbrs_id;
    }

    /**
     * @param int $nmbrs_id
     * @return UserModel
     */
    public function setNmbrsId(?int $nmbrs_id): UserModel
    {
        $this->nmbrs_id = $nmbrs_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getInitials(): ?string
    {
        return $this->initials;
    }

    /**
     * @param string $initials
     * @return UserModel
     */
    public function setInitials(?string $initials): UserModel
    {
        $this->initials = $initials;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @return UserModel
     */
    public function setFirstName(?string $first_name): UserModel
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getInsertion(): ?string
    {
        return $this->insertion;
    }

    /**
     * @param string $insertion
     * @return UserModel
     */
    public function setInsertion(?string $insertion): UserModel
    {
        $this->insertion = $insertion;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     * @return UserModel
     */
    public function setLastName(?string $last_name): UserModel
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getInsertion() . ' ' . $this->getLastName();
    }

    public function getInitialFullName()
    {
        return $this->getInitials() . ' ' . $this->getInsertion() . ' ' . $this->getLastName();
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
     * @return UserModel
     */
    public function setPhone(?string $phone): UserModel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasDriversLicense(): ?bool
    {
        return $this->has_drivers_license;
    }

    /**
     * @param bool $has_drivers_license
     * @return UserModel
     */
    public function setHasDriversLicense(?bool $has_drivers_license): UserModel
    {
        $this->has_drivers_license = $has_drivers_license;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): ?string
    {
        return $this->date_of_birth;
    }

    /**
     * @param string $date_of_birth
     * @return UserModel
     */
    public function setDateOfBirth(?string $date_of_birth): UserModel
    {
        $this->date_of_birth = $date_of_birth;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountryOfBirthId(): ?int
    {
        return $this->country_of_birth_id;
    }

    /**
     * @param int $country_of_birth_id
     * @return UserModel
     */
    public function setCountryOfBirthId(?int $country_of_birth_id): UserModel
    {
        $this->country_of_birth_id = $country_of_birth_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNationalityId(): ?int
    {
        return $this->nationality_id;
    }

    /**
     * @param int $nationality_id
     * @return UserModel
     */
    public function setNationalityId(?int $nationality_id): UserModel
    {
        $this->nationality_id = $nationality_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaritalStatusId(): ?int
    {
        return $this->marital_status_id;
    }

    /**
     * @param int $marital_status_id
     * @return UserModel
     */
    public function setMaritalStatusId(?int $marital_status_id): UserModel
    {
        $this->marital_status_id = $marital_status_id;
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
     * @param string $password
     * @return UserModel
     */
    public function setPassword(?string $password): UserModel
    {
        $this->password = $password;
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
     * @param string $email
     * @return UserModel
     */
    public function setEmail(?string $email): UserModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailVerifiedAt(): ?string
    {
        return $this->email_verified_at;
    }

    /**
     * @param string $email_verified_at
     * @return UserModel
     */
    public function setEmailVerifiedAt(?string $email_verified_at): UserModel
    {
        $this->email_verified_at = $email_verified_at;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return UserModel
     */
    public function setActive(?bool $active): UserModel
    {
        $this->active = $active;
        return $this;
    }


    /**
     * @return AddressModel
     */
    public function getAddress(): ?AddressModel
    {
        return $this->address;
    }

    /**
     * @param AddressModel $address
     * @return UserModel
     */
    public function setAddress(?AddressModel $address): ?UserModel
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return EmergencyContactModel
     */
    public function getEmergencyContact(): ?EmergencyContactModel
    {
        return $this->emergency_contact;
    }

    /**
     * @param EmergencyContactModel $emergency_contact
     * @return UserModel
     */
    public function setEmergencyContact(?EmergencyContactModel $emergency_contact): UserModel
    {
        $this->emergency_contact = $emergency_contact;
        return $this;
    }

    /**
     * @return RoleModel
     */
    public function getRole(): ?RoleModel
    {
        return $this->role;
    }

    /**
     * @param RoleModel $role
     * @return UserModel
     */
    public function setRole(?RoleModel $role): UserModel
    {
        $this->role = $role;
        return $this;
    }


    /**
     * @return int
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return UserModel
     */
    public function setRoleId(?int $roleId): UserModel
    {
        $this->roleId = $roleId;

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
     * @return UserModel
     */
    public function setLocation(?string $location): UserModel
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getIntoServiceDate(): ?Carbon
    {
        return $this->intoServiceDate;
    }

    /**
     * @param Carbon $intoServiceDate
     * @return UserModel
     */
    public function setIntoServiceDate(?Carbon $intoServiceDate): UserModel
    {
        $this->intoServiceDate = $intoServiceDate;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndDateContract(): ?Carbon
    {
        return $this->endDateContract;
    }

    /**
     * @param Carbon $endDateContract
     * @return UserModel
     */
    public function setEndDateContract(?Carbon $endDateContract): UserModel
    {
        $this->endDateContract = $endDateContract;
        return $this;
    }

    /**
     * @return int
     */
    public function getGenderId(): ?int
    {
        return $this->genderId;
    }

    /**
     * @param int $genderId
     * @return UserModel
     */
    public function setGenderId(?int $genderId): UserModel
    {
        $this->genderId = $genderId;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWorkOnProject(): ?Collection
    {
        return $this->workOnProject;
    }

    /**
     * @param Collection $workOnProject
     * @return UserModel
     */
    public function setWorkOnProject(?Collection $workOnProject): UserModel
    {
        $this->workOnProject = $workOnProject;

        return $this;
    }

    /**
     * @return EmployeeContractModel
     */
    public function getEmployeeContract(): ?EmployeeContractModel
    {
        return $this->employeeContract;
    }

    /**
     * @param EmployeeContractModel $employeeContract
     * @return UserModel
     */
    public function setEmployeeContract(?EmployeeContractModel $employeeContract): ?UserModel
    {
        $this->employeeContract = $employeeContract;
        return $this;
    }

    /**
     * @return int
     */
    public function getBsn(): ?int
    {
        return $this->bsn;
    }

    /**
     * @param int $bsn
     * @return UserModel
     */
    public function setBsn(?int $bsn): ?UserModel
    {
        $this->bsn = $bsn;
        return $this;
    }

    /**
     * @return string
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     * @return UserModel
     */
    public function setIban(?string $iban): UserModel
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncomeTax(): ?bool
    {
        return $this->income_tax;
    }

    /**
     * @param bool $income_tax
     * @return UserModel
     */
    public function setIncomeTax(?bool $income_tax): UserModel
    {
        $this->income_tax = $income_tax;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getOutOfService(): ?Carbon
    {
        return $this->out_of_service;
    }

    /**
     * @param Carbon $out_of_service
     * @return UserModel
     */
    public function setOutOfService(?Carbon $out_of_service): UserModel
    {
        $this->out_of_service = $out_of_service;
        return $this;
    }

    /**
     * @return float
     */
    public function getHourlyWage(): ?float
    {
        return $this->hourlyWage;
    }

    /**
     * @param float $hourlyWage
     * @return UserModel
     */
    public function setHourlyWage(?float $hourlyWage): UserModel
    {
        $this->hourlyWage = $hourlyWage;

        return $this;
    }
}
