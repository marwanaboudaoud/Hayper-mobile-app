<?php


namespace App\Src\Services\Hyper\CommissionRate;

interface ICommissionRateDeleteService
{
    /**
     * @param int $projectId
     * @return boolean
     */
    public function deleteByProjectId(int $projectId): bool;
}
