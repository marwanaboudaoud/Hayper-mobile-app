<?php


namespace App\Src\Services\Hyper\Role;

interface IRoleDeleteService
{
    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
