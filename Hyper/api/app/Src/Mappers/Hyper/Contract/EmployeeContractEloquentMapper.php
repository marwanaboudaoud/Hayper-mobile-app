<?php


namespace App\Src\Mappers\Hyper\Contract;

use App\EmploymentContract;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Contract\ContractExpireModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class EmployeeContractEloquentMapper
{
    public static function toCollectionEmployeeContractModel(Collection $collection)
    {
        return $collection->map(function (EmploymentContract $employmentContract) {
            return self::toEmployeeContractModel($employmentContract);
        });
    }

    /**
     * @param EmploymentContract $employmentContract
     * @return EmployeeContractModel
     * @throws \Exception
     */
    public static function toEmployeeContractModel(EmploymentContract $employmentContract)
    {
        return self::toEmployeeContractModelWithoutUser($employmentContract)->setUser(
            UserEloquentMapper::toUserModel($employmentContract->user)
        );
    }

    public static function toEmployeeContractModelWithoutUser(?EmploymentContract $employmentContract)
    {
        if (!$employmentContract) {
            return null;
        }

        return (new EmployeeContractModel())
            ->setId($employmentContract->id)
            ->setStartDate(
                Carbon::createFromFormat('Y-m-d', $employmentContract->start_date)
            )
            ->setEndDate(
                ($employmentContract->end_date) ?
                    Carbon::createFromFormat('Y-m-d', $employmentContract->end_date) : null
            )
            ->setTrialPerDay($employmentContract->trial_per_day)
            ->setUserId($employmentContract->user_id)
            ->setDocumentNumber($employmentContract->document_number)
            ->setContractInMonths($employmentContract->contract_in_months)
            ->setArchived(
                !$employmentContract->deleted_at ? false : true
            );
    }

    public static function toContractExpireModelCollection(Collection $collection)
    {
        return $collection->map(function (EmploymentContract $employmentContract) {
            return self::toContractExpireModel($employmentContract);
        });
    }

    public static function toContractExpireModel(EmploymentContract $employmentContract)
    {
        $user = $employmentContract->user;

        return (new ContractExpireModel())
            ->setId($employmentContract->id)
            ->setEmployeeName(
                UserEloquentMapper::toUserModel($user)->getFullName()
            )
            ->setEndDate(
                Carbon::createFromFormat('Y-m-d', $employmentContract->end_date)
            )
            ->setContractInMonths($employmentContract->contract_in_months)
            ->setTillEndDateInDays($employmentContract->till_end_date_in_days)
            ->setAmountContracts($user->contracts_count);
    }
}
