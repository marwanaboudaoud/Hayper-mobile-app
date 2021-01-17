<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\Salary;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Models\Hyper\Salary\SalaryTotalPerDayModel;
use Illuminate\Support\Collection;

class SalaryModelMapper
{
    public static function toModelWithSubTotal(
        SalaryModel $salaryModel,
        Collection $subTotalExBonus,
        Collection $subTotalBonus,
        Collection $subTotalInclBonus
    ) {
        $salaryModel = SalaryModelMapper::toModelWithSubTotalExBonusDay($salaryModel, $subTotalExBonus);
        $salaryModel = SalaryModelMapper::toModelWithSubTotalBonusDay($salaryModel, $subTotalBonus);
        $salaryModel = SalaryModelMapper::toModelWithSubTotalInclBonusDay($salaryModel, $subTotalInclBonus);

        return $salaryModel;
    }

    protected static function mapSalaryDays(SalaryModel $salaryModel, Collection $salaryTotalPerDayModel, \Closure $map)
    {
        $salaryModel->getSalaryDays()->filter(function ($salaryDay) use ($salaryTotalPerDayModel) {
            return $salaryTotalPerDayModel->search(function ($salaryRow) use ($salaryDay) {
                return $salaryDay->getId() !== $salaryRow->getId();
            });
        })->map(function ($salaryDay) use ($salaryTotalPerDayModel, $map) {

            $rowKey = $salaryTotalPerDayModel->search(function ($salaryRow) use ($salaryDay) {
                return $salaryDay->getId() === $salaryRow->getId();
            });

            if (isset($salaryTotalPerDayModel[$rowKey])) {
                return $map($salaryDay, $salaryTotalPerDayModel, $rowKey);
            }
        });

        return $salaryModel;
    }

    /**
     * Map salary model to salary model with subtotal per day
     *
     * @param SalaryModel $salaryModel
     * @param Collection $salaryTotalPerDayModel
     * @return SalaryModel
     */
    public static function toModelWithSubTotalInclBonusDay(
        SalaryModel $salaryModel,
        Collection $salaryTotalPerDayModel
    ) {
        return self::mapSalaryDays(
            $salaryModel,
            $salaryTotalPerDayModel,
            function (
                $salaryDay,
                $salaryTotalPerDayModel,
                $rowKey
            ) {
                return $salaryDay->setSubTotalInclBonusDay($salaryTotalPerDayModel[$rowKey]);
            }
        );
    }

    public static function toModelWithSubTotalExBonusDay(
        SalaryModel $salaryModel,
        Collection $salaryTotalPerDayModel
    ) {
        return self::mapSalaryDays(
            $salaryModel,
            $salaryTotalPerDayModel,
            function (
                $salaryDay,
                $salaryTotalPerDayModel,
                $rowKey
            ) {
                $salaryDay->setSubTotalExBonusDay($salaryTotalPerDayModel[$rowKey]);
            }
        );
    }

    public static function toModelWithSubTotalBonusDay(
        SalaryModel $salaryModel,
        Collection $salaryTotalPerDayModel
    ) {
        return self::mapSalaryDays(
            $salaryModel,
            $salaryTotalPerDayModel,
            function (
                $salaryDay,
                $salaryTotalPerDayModel,
                $rowKey
            ) {
                $salaryDay->setSubTotalBonusDay($salaryTotalPerDayModel[$rowKey]);
            }
        );
    }

    public static function toArray(SalaryModel $salaryModel)
    {
        $is_closed = $salaryModel->isClosed() == false ? false : true;
        return [
            'id' => $salaryModel->getId(),
            'is_closed' => $is_closed,
            'date' => $salaryModel->getDate()->format('Y-m'),
            'employee_name' => $salaryModel->getEmployee()->getFullName(),
            'heading' => $salaryModel->getHeading(),
            'description' => $salaryModel->getDescription(),
            'salary' => $salaryModel->getTotalSalary(),
            'salary_days' => SalaryDayModelMapper::toCollectionArray($salaryModel->getSalaryDays()),
            'salary_manual' => SalaryManuelModelMapper::toCollectionArray($salaryModel->getSalaryManual()),
        ];
    }

    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (SalaryModel $salaryModel) {
            return self::toArray($salaryModel);
        });
    }

    /**
     * @param SalaryModel $salaryModel
     * @return Salary
     */
    public static function toEloquent(SalaryModel $salaryModel)
    {
        $salary = new Salary();
        $salary->date = $salaryModel->getDate()->toDateString();
        $salary->heading = $salaryModel->getHeading();
        $salary->description = $salaryModel->getDescription();
        $salary->is_closed = $salaryModel->isClosed();
        $salary->user_id = $salaryModel->getEmployee()->getId();

        return $salary;
    }
}
