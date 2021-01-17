<?php


namespace App\Src\Mappers\Hyper\Contract;

use App\EmploymentContract;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class EmployeeContractModelMapper
{
    /**
     * @param Collection $collection
     * @return array
     */
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (EmployeeContractModel $employeeContractModel) {
            return self::toArray($employeeContractModel);
        })->toArray();
    }

    /**
     * @param EmployeeContractModel $employeeContractModel
     * @return array
     */
    public static function toArray(?EmployeeContractModel $employeeContractModel)
    {
        return $employeeContractModel ? [
            'id' => $employeeContractModel->getId(),
            'start_date' => $employeeContractModel->getStartDate()->toDateString(),
            'end_date' => $employeeContractModel->getEndDate()->toDateString(),
            'trial_per_day' => $employeeContractModel->getTrialPerDay(),
            'user_id' => $employeeContractModel->getUserId(),
            'employee_name' => $employeeContractModel->getUser() ?
                $employeeContractModel->getUser()->getFullName() : null,
            'document_number' => $employeeContractModel->getDocumentNumber(),
            'contract_in_months' => $employeeContractModel->getContractInMonths() . ' maanden',
            'is_archived' => $employeeContractModel->isArchived()
        ] : [];
    }

    public static function toEloquentModel(EmployeeContractModel $employeeContractModel)
    {
        $employeeContract = new EmploymentContract();
        $employeeContract->start_date = $employeeContractModel->getStartDate()->toDateString();
        $employeeContract->end_date = $employeeContractModel->getEndDate() ?
            $employeeContractModel->getEndDate()->toDateString() : null;
        $employeeContract->trial_per_day = $employeeContractModel->getTrialPerDay();
        $employeeContract->user_id = $employeeContractModel->getUserId();
        $employeeContract->document_number = $employeeContractModel->getDocumentNumber();

        return $employeeContract;
    }
}
