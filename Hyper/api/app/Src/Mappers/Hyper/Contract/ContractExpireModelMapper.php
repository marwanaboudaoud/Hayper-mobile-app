<?php


namespace App\Src\Mappers\Hyper\Contract;

use App\Src\Models\Hyper\Contract\ContractExpireModel;
use Illuminate\Support\Collection;

class ContractExpireModelMapper
{
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (ContractExpireModel $contractExpireModel) {
            return self::toArray($contractExpireModel);
        })->toArray();
    }

    public static function toArray(ContractExpireModel $contractExpireModel)
    {
        return [
            'id' => $contractExpireModel->getId(),
            'employee_name' => $contractExpireModel->getEmployeeName(),
            'contract_in_months' => (string)$contractExpireModel->getContractInMonths(),
            'end_date' => $contractExpireModel->getEndDate()->toDateString(),
            'till_end_date_in_days' => (string)$contractExpireModel->getTillEndDateInDays(),
            'amount_contracts' => $contractExpireModel->getAmountContracts()
        ];
    }
}
