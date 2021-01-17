<?php


namespace App\Src\Mappers\Hyper\User;

use App\Src\Mappers\Hyper\Address\AddressEloquentMapper;
use App\Src\Mappers\Hyper\Contract\EmployeeContractEloquentMapper;
use App\Src\Mappers\Hyper\EmergencyContact\EmergencyContactEloquentMapper;
use App\Src\Mappers\Hyper\EmergencyContact\EmergencyContactModelMapper;
use App\Src\Mappers\Hyper\Role\RoleEloquentMapper;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use mysql_xdevapi\XSession;

class UserEloquentMapper
{
    public static function toCollectionUserModel(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return self::toUserModel($item);
            }
        );
    }

    public static function toUserModel(User $user)
    {
        $address = $user->addresses->first();

        $emergencyContact = $user->emergencyContacts->first();
        $intoService = null;
        $outService = null;
        $contract = null;

        if ($address) {
            $address = AddressEloquentMapper::toAddressModel($address);
        }

        if ($emergencyContact) {
            $emergencyContact = EmergencyContactEloquentMapper::toEmergencyContactModel($emergencyContact);
        }

        if ($user->into_service) {
            $intoService = Carbon::createFromFormat('Y-m-d', $user->into_service);
        }

        if ($user->out_of_service) {
            $outService = Carbon::createFromFormat('Y-m-d', $user->out_of_service);
        }

        if ($user->contracts) {
            $contract = EmployeeContractEloquentMapper::toEmployeeContractModelWithoutUser($user->contracts->first());
        }

        return (new UserModel())
            ->setId($user->id)
            ->setHourlyWage($user->hourly_wage)
            ->setFirstname($user->first_name)
            ->setLastname($user->last_name)
            ->setPassword($user->password)
            ->setActive(boolval($user->is_active))
            ->setEmail($user->email)
            ->setNmbrsId($user->nmbrs_id)
            ->setEmployeeContract($contract)
            ->setGenderId($user->gender_id)
            ->setAlias($user->alias)
            ->setInitials($user->initials)
            ->setInsertion($user->insertion)
            ->setPhone($user->phone)
            ->setDateofbirth($user->date_of_birth)
            ->setCountryOfBirthId($user->country_of_birth_id)
            ->setNationalityId($user->nationality_id)
            ->setHasDriversLicense($user->has_drivers_license)
            ->setMaritalStatusId($user->marital_status_id)
            ->setEmail($user->email)
            ->setNmbrsId($user->nmbrs_id)
            ->setActive(boolval($user->is_active))
            ->setEmail($user->email)
            ->setAddress($address)
            ->setEmergencyContact($emergencyContact)
            ->setRoleId($user->role_id)
            ->setRole(
                $user->role ? RoleEloquentMapper::toModel($user->role) : null
            )
            ->setLocation('Hyper Amsterdam')
            ->setIntoServiceDate(
                $intoService
            )
            ->setEndDateContract(
                $outService
            )
            ->setOutOfService($outService)
            ->setIban($user->iban)
            ->setIncomeTax($user->income_tax);
        die;
    }

    public static function toApiTokenModel(User $user)
    {
        return (new ApiTokenModel())
            ->setToken($user->api_token)
            ->setUser(
                UserEloquentMapper::toUserModel($user)
            );
    }
}
