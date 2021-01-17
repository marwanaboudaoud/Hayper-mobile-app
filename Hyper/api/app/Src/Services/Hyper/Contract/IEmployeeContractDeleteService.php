<?php


namespace App\Src\Services\Hyper\Contract;

interface IEmployeeContractDeleteService
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);
}
