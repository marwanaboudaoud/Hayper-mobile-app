<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\SalaryDay;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryManualModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryDayModelMapper
{
    public static function toCollectionArray(Collection $collection)
    {
        if ($collection->count() === 0) {
            return [];
        }

        return $collection->map(function (SalaryDayModel $item) {
            return self::toArray($item);
        })->toArray();
    }

    public static function toArray(SalaryDayModel $salaryDayModel)
    {
        return [
            'id' => $salaryDayModel->getId(),
            'date' => $salaryDayModel->getDate()->toDateString(),
            'has_driven' => $salaryDayModel->isHasDriven(),
            'is_manual' => $salaryDayModel->isManual(),
            'partner' => methodExistOrNull($salaryDayModel, 'getPartner') ?
                $salaryDayModel->getPartner()->getName() : null,
            'sub_total_ex_bonus_day' => methodExistOrNull($salaryDayModel, 'getSubTotalExBonusDay') ?
                $salaryDayModel->getSubTotalExBonusDay()->getSalary() : 0,
            'sub_total_bonus_day' => methodExistOrNull($salaryDayModel, 'getSubTotalBonusDay') ?
                $salaryDayModel->getSubTotalBonusDay()->getSalary() : 0,
            'sub_total_incl_bonus_day' => methodExistOrNull($salaryDayModel, 'getSubTotalInclBonusDay') ?
                $salaryDayModel->getSubTotalInclBonusDay()->getSalary() : 0,
            'rows' => SalaryRowModelMapper::toCollectionArray($salaryDayModel->getRows())
        ];
    }

    /**
     * @param SalaryDayModel $salaryDayModel
     * @return SalaryDay
     */
    public static function toEloquentModel(SalaryDayModel $salaryDayModel)
    {
        $model = new SalaryDay();
        $model->id = $salaryDayModel->getId();
        $model->date = $salaryDayModel->getDate()->toDateString();
        $model->has_driven = $salaryDayModel->isHasDriven();
        $model->is_manual = $salaryDayModel->isManual();
        $model->salary_id = $salaryDayModel->getSalaryId();
        $model->partner_id = methodExistOrNull($salaryDayModel, 'getPartner') ?
            $salaryDayModel->getPartner()->getId() : null;

        return $model;
    }

    public static function toSalaryManualModel(SalaryDayModel $salary)
    {
        $salaryRow = $salary->getRows()->first();

        return (new SalaryManualModel())
            ->setDate(
                $salary->getDate()
            )
            ->setDescription($salaryRow->getAmount())
            ->setPrice($salaryRow->getPrice());
    }
}
