<?php


namespace App\Src\Services\Hyper\CommissionRate;

use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use Illuminate\Support\Collection;

interface ICommissionRateStoreService
{
    /**
     * @param CommissionRateModel $model
     * @return CommissionRateModel
     */
    public function store(CommissionRateModel $model);

    public function storeCollection(Collection $commissionRates);
}
