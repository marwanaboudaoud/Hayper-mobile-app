<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Pagination\EmployeePaginationRequest;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Models\Hyper\User\UserModel;

class EmployeeRequestSearchMapper
{

    /**
     * @param EmployeePaginationRequest $employeePaginationRequest
     * @return mixed
     */
    public static function toEmployeeModel(EmployeePaginationRequest $employeePaginationRequest)
    {
        $roleTitle = keyExistOrNull($employeePaginationRequest, 'search', 'role_title');
        $role = (new RoleModel())->setTitle($roleTitle);

        return (new PaginationEmployeeModel())
            ->setPage($employeePaginationRequest->page)
            ->setLimit($employeePaginationRequest->limit)
            ->setOrderBy($employeePaginationRequest->order_by)
            ->setDirection($employeePaginationRequest->direction)
            ->setEmployee(
                (new UserModel())
                    ->setId((int)keyExistOrNull($employeePaginationRequest, 'search', 'id'))
                    ->setAlias(keyExistOrNull($employeePaginationRequest, 'search', 'alias'))
                    ->setInitials(keyExistOrNull($employeePaginationRequest, 'search', 'initials'))
                    ->setFirstName(keyExistOrNull($employeePaginationRequest, 'search', 'first_name'))
                    ->setInsertion(keyExistOrNull($employeePaginationRequest, 'search', 'insertion'))
                    ->setLastName(keyExistOrNull($employeePaginationRequest, 'search', 'last_name'))
                    ->setEmail(keyExistOrNull($employeePaginationRequest, 'search', 'email'))
                    ->setPhone(keyExistOrNull($employeePaginationRequest, 'search', 'phone'))
                    ->setGenderId(keyExistOrNull($employeePaginationRequest, 'search', 'gender_id'))
                    ->setHasDriversLicense(keyExistOrNull($employeePaginationRequest, 'search', 'has_drivers_license'))
                    ->setDateOfBirth(keyExistOrNull($employeePaginationRequest, 'search', 'date_of_birth'))
                    ->setCountryOfBirthId(keyExistOrNull($employeePaginationRequest, 'search', 'country_of_birth_id'))
                    ->setNationalityId(keyExistOrNull($employeePaginationRequest, 'search', 'nationality_id'))
                    ->setMaritalStatusId(keyExistOrNull($employeePaginationRequest, 'search', 'marital_status_id'))
                    ->setBsn(keyExistOrNull($employeePaginationRequest, 'search', 'bsn'))
                    ->setIncomeTax(keyExistOrNull($employeePaginationRequest, 'search', 'income_tax'))
                    ->setRole($role)
            );
    }
}
