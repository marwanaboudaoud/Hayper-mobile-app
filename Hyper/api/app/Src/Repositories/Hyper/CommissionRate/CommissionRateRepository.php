<?php


namespace App\Src\Repositories\Hyper\CommissionRate;

use App\CommissionRate;
use App\Src\Mappers\Hyper\CommissionRate\CommissionRateEloquentModelMapper;
use App\Src\Mappers\Hyper\CommissionRate\CommissionRateModelMapper;
use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;

class CommissionRateRepository implements ICommissionRateRepository
{
    /**
     * @param CommissionRateModel $commissionRateModel
     * @return CommissionRateModel
     */
    public function store(CommissionRateModel $commissionRateModel): ?CommissionRateModel
    {
        $eloquent = CommissionRateModelMapper::toEloquentModel($commissionRateModel);
        $eloquent->save();

        return CommissionRateEloquentModelMapper::toModel($eloquent);
    }

    /**
     * @inheritDoc
     */
    public function delete(array $where): bool
    {
        return CommissionRate::where($where)->delete();
    }
}
