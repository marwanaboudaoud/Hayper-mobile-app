<?php


namespace App\Src\Repositories\Hyper\CommissionRate;

use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;

interface ICommissionRateRepository
{
    /**
     * @param CommissionRateModel $commissionRateModel
     * @return CommissionRateModel
     */
    public function store(CommissionRateModel $commissionRateModel): ?CommissionRateModel;

    /**
     * @param array $where
     * @return boolean
     */
    public function delete(array $where): bool;
}
