<?php


namespace App\Src\Mappers\Hyper\User;

use App\Src\Mappers\Hyper\Address\AddressModelMapper;
use App\Src\Mappers\Hyper\Contract\EmployeeContractModelMapper;
use App\Src\Mappers\Hyper\EmergencyContact\EmergencyContactModelMapper;
use App\Src\Mappers\Hyper\Role\RoleModelMapper;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Models\Hyper\User\UserModel;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Null_;

class UserModelMapper
{
    /**
     * @param Collection|null $collection
     * @return array|Collection
     */
    public static function toCollectionArray(?Collection $collection)
    {
        if (!$collection) {
            return [];
        }

        return $collection->map(
            function ($item) {
                return self::toArray($item);
            }
        )->toArray();
    }

    /**
     * @param UserModel $userModel
     * @return array
     */
    public static function toArray(UserModel $userModel)
    {
        return [
            'id' => $userModel->getId(),
            'alias' => $userModel->getAlias(),
            'nmbrs_id' => $userModel->getNmbrsId(),
            'initials' => $userModel->getInitials(),
            'first_name' => $userModel->getFirstName(),
            'insertion' => $userModel->getInsertion(),
            'last_name' => $userModel->getLastName(),
            'phone' => $userModel->getPhone(),
            'address' => AddressModelMapper::toArray($userModel->getAddress()),
            'emergency_contact' => EmergencyContactModelMapper::toArray($userModel->getEmergencyContact()),
            'contract' => EmployeeContractModelMapper::toArray($userModel->getEmployeeContract()),
            'has_drivers_license' => $userModel->isHasDriversLicense(),
            'date_of_birth' => $userModel->getDateOfBirth(),
            'country_of_birth_id' => $userModel->getCountryOfBirthId(),
            'nationality_id' => $userModel->getNationalityId(),
            'marital_status_id' => $userModel->getMaritalStatusId(),
            'email' => $userModel->getEmail(),
            'is_active' => $userModel->isActive(),
            'gender_id' => $userModel->getGenderId(),
            'role' => RoleModelMapper::toArray($userModel->getRole()),
            'role_title' => self::toRoleTitle($userModel->getRole()),
            'location' => $userModel->getLocation(),
            'into_service' => toDateString($userModel->getIntoServiceDate()),
            'out_of_service' => toDateString($userModel->getEndDateContract()),
            'iban' => $userModel->getIban(),
            'income_tax' => $userModel->isIncomeTax()
        ];
    }

    private static function toRoleTitle(?RoleModel $roleModel)
    {
        return $roleModel ? $roleModel->getTitle() : null;
    }

    public static function toEloquentCollectionModel(Collection $collection)
    {
        return self::toCollectionModel(
            $collection,
            function (UserModel $item) {
                return self::toEloquentModel($item);
            }
        );
    }

    public static function toEloquentExportCollectionModel(Collection $collection)
    {
        return self::toCollectionModel(
            $collection,
            function (UserModel $item) {
                return self::toEloquentExportModel($item);
            }
        );
    }

    public static function toCollectionModel(Collection $collection, \Closure $toModel)
    {
        return $collection->map(
            function ($item) use ($toModel) {
                return $toModel($item);
            }
        );
    }

    /**
     * @param UserModel $userModel
     * @return User
     */
    public static function toEloquentModel(UserModel $userModel)
    {
        $user = new User();
        $user->id = $userModel->getId();
        $user->nmbrs_id = $userModel->getNmbrsId();
        $user->alias = $userModel->getAlias();
        $user->initials = $userModel->getInitials();
        $user->first_name = $userModel->getFirstName();
        $user->insertion = $userModel->getInsertion();
        $user->last_name = $userModel->getLastName();
        $user->gender_id = $userModel->getGenderId();
        $user->phone = $userModel->getPhone();
        $user->has_drivers_license = $userModel->isHasDriversLicense();
        $user->date_of_birth = $userModel->getDateOfBirth();
        $user->country_of_birth_id = $userModel->getCountryOfBirthId();
        $user->nationality_id = $userModel->getNationalityId();
        $user->marital_status_id = $userModel->getMaritalStatusId();
        $user->role_id = $userModel->getRoleId();
        $user->iban = $userModel->getIban();
        $user->income_tax = $userModel->isIncomeTax();
        $user->email = $userModel->getEmail();
        $user->password = $userModel->getPassword();
        $user->is_active = $userModel->isActive();
        $user->out_of_service = $userModel->getOutOfService();

        return $user;
    }

    public static function toEloquentUpdateModel(UserModel $orgModel, UserModel $updateModel)
    {

        $user = new User();
        $user->id = $orgModel->getId();
        $user->nmbrs_id = $orgModel->getNmbrsId() ?? $updateModel->getNmbrsId();
        $user->alias = $updateModel->getAlias() ?? $orgModel->getAlias();
        $user->initials = $updateModel->getInitials() ?? $orgModel->getInitials();
        $user->first_name = $updateModel->getFirstName() ?? $orgModel->getFirstName();
        $user->insertion = $updateModel->getInsertion() ?? $orgModel->getInsertion();
        $user->last_name = $updateModel->getLastName() ?? $orgModel->getLastName();
        $user->gender_id = $updateModel->getGenderId() ?? $orgModel->getGenderId();
        $user->phone = $updateModel->getPhone() ?? $orgModel->getPhone();
        $user->has_drivers_license = $updateModel->isHasDriversLicense() ?? $orgModel->isHasDriversLicense();
        $user->date_of_birth = $updateModel->getDateOfBirth() ?? $orgModel->getDateOfBirth();
        $user->country_of_birth_id = $updateModel->getCountryOfBirthId() ?? $orgModel->getCountryOfBirthId();
        $user->nationality_id = $updateModel->getNationalityId() ?? $orgModel->getNationalityId();
        $user->marital_status_id = $updateModel->getMaritalStatusId() ?? $orgModel->getMaritalStatusId();
        $user->role_id = $updateModel->getRoleId() ?? $orgModel->getRoleId();
        $user->iban = $updateModel->getIban() ?? $orgModel->getIban();
        $user->income_tax = $updateModel->isIncomeTax() ?? $orgModel->isIncomeTax();
        $user->email = $updateModel->getEmail() ?? $orgModel->getEmail();
        $user->password = $updateModel->getPassword() ?? $orgModel->getPassword();
        $user->is_active = $updateModel->isActive() ?? $orgModel->isActive();
        $user->out_of_service = $updateModel->getOutOfService() ? $updateModel->getOutOfService()->toDateString()
            ?? $orgModel->getOutOfService()->toDateString() : null;

        return $user;
    }

    public static function toEloquentExportModel(UserModel $userModel)
    {
        $user = self::toEloquentModel($userModel);
        $user->role = $userModel->getRole();
        $user->into_service_date = $userModel->getIntoServiceDate();
        $user->end_date_contract = $userModel->getEndDateContract();
        $user->location = $userModel->getLocation();
        $user->role_title = $userModel->getRole() ? $userModel->getRole()->getTitle() : null;
        unset($user->nmbrs_id);
        unset($user->initials);
        unset($user->phone);
        unset($user->password);
        unset($user->phone);
        unset($user->marital_status_id);
        unset($user->nationality_id);
        unset($user->country_of_birth_id);

        return $user;
    }
}
