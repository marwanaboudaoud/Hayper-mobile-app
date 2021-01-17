<?php


namespace App\Src\Mappers\Hyper\CommissionRate;

use App\CommissionRate;
use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use Illuminate\Support\Collection;

class CommissionRateEloquentModelMapper
{
    /**
     * @param CommissionRate $commissionRate
     * @return CommissionRateModel
     */
    public static function toModel(CommissionRate $commissionRate)
    {
        return (new CommissionRateModel())
            ->setId($commissionRate->id)
            ->setAmount($commissionRate->amount)
            ->setRate($commissionRate->rate)
            ->setProjectId($commissionRate->project_id)
            ->setRoleId($commissionRate->role_id);
    }

    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function (CommissionRate $commissionRate) {
            return self::toModel($commissionRate);
        });
    }
}
