<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Src\Models\Hyper\Address\AddressModel;

class EmployeeAddressRequestStoreMapper
{
    /**
     * @param  array $employeeRequest
     * @return AddressModel
     */
    public static function toAddressModel(\stdClass $employeeRequest)
    {
        return (new AddressModel())
            ->setStreet(
                propExistOrNull($employeeRequest, 'street')
            )
            ->setHouseNumber(
                propExistOrNull($employeeRequest, 'house_number')
            )
            ->setAddition(
                propExistOrNull($employeeRequest, 'addition')
            )
            ->setPostcode(
                propExistOrNull($employeeRequest, 'postcode')
            )
            ->setCity(
                propExistOrNull($employeeRequest, 'city')
            );
    }
}
