<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Contract\ContractStoreRequest;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use Carbon\Carbon;

class ContractRequestStoreMapper
{
    /**
     * @param \stdClass $contractRequest
     * @return EmployeeContractModel
     * @throws \Exception
     */
    public static function toEmployeeContractModel(\stdClass $contractRequest)
    {
        return (new EmployeeContractModel())
            ->setStartDate(new Carbon(propExistOrNull($contractRequest, 'start_date')))
            ->setEndDate(new Carbon(propExistOrNull($contractRequest, 'end_date')))
            ->setTrialPerDay(propExistOrNull($contractRequest, 'trial_per_day'))
            ->setDocumentNumber(propExistOrNull($contractRequest, 'document_number'));
    }
}
