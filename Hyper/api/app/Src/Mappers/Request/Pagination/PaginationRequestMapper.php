<?php


namespace App\Src\Mappers\Request\Pagination;

use App\Http\Requests\Pagination\PaginationRequest;
use App\Src\Mappers\Request\Partner\PartnerRequestSearchMapper;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Models\Hyper\User\UserModel;

class PaginationRequestMapper
{
    public static function toModel(PaginationRequest $employeePaginationRequest)
    {
        $role = keyExistOrNull($employeePaginationRequest, 'search', 'role_title');
        $roleObj = (new RoleModel())->setTitle($role);

        return (new PaginationEmployeeModel())
            ->setPage($employeePaginationRequest->page)
            ->setLimit($employeePaginationRequest->limit)
            ->setOrderBy($employeePaginationRequest->order_by)
            ->setDirection($employeePaginationRequest->direction)
            ->setEmployee(
                (new UserModel())
                    ->setId(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'id'
                    ))
                    ->setAlias(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'alias'
                    ))
                    ->setInitials(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'initials'
                    ))
                    ->setFirstName(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'first_name'
                    ))
                    ->setInsertion(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'insertion'
                    ))
                    ->setLastName(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'last_name'
                    ))
                    ->setEmail(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'email'
                    ))
                    ->setPhone(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'phone'
                    ))
                    ->setGenderId(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'gender_id'
                    ))
                    ->setHasDriversLicense(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'has_drivers_license'
                    ))
                    ->setDateOfBirth(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'date_of_birth'
                    ))
                    ->setCountryOfBirthId(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'country_of_birth_id'
                    ))
                    ->setNationalityId(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'nationality_id'
                    ))
                    ->setMaritalStatusId(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'marital_status_id'
                    ))
                    ->setBsn(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'bsn'
                    ))
                    ->setIncomeTax(keyExistOrNull(
                        $employeePaginationRequest,
                        'search',
                        'income_tax'
                    ))
                    ->setRole($roleObj)
            );
    }
}
