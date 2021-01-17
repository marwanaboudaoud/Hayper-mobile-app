<?php


namespace App\Src\Mappers\Hyper\CommissionRate;

use App\CommissionRate;
use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use Illuminate\Support\Collection;

class CommissionRateModelMapper
{
    /**
     * @param CommissionRateModel $commissionRateModel
     * @return CommissionRate
     */
    public static function toEloquentModel(CommissionRateModel $commissionRateModel)
    {
        $model = new CommissionRate();
        $model->id = $commissionRateModel->getId();
        $model->rate = $commissionRateModel->getRate();
        $model->amount = $commissionRateModel->getAmount();
        $model->project_id = $commissionRateModel->getProjectId();
        $model->role_id = $commissionRateModel->getRoleId();

        return $model;
    }

    public static function toCollectionArray(?Collection $commissionRates)
    {
        return $commissionRates->map(function (CommissionRateModel $commissionRateModel) {
            return self::toArray($commissionRateModel);
        });
    }

    public static function toArray(CommissionRateModel $commissionRateModel)
    {
        return [
            'id' => $commissionRateModel->getId(),
            'rate' => $commissionRateModel->getRate(),
            'amount' => $commissionRateModel->getAmount(),
            'project_id' => $commissionRateModel->getProjectId(),
            'role_id' => $commissionRateModel->getRoleId()
        ];
    }
}
