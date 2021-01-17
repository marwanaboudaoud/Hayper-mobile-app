<?php


namespace App\Src\Services\Hyper\Employee;

use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;

interface IEmployeeUpdateService
{
    /**
     * @param int $id
     * @param UserModel $userModel
     * @return UserModel
     */
    public function update(int $id, UserModel $userModel);

    /**
     * @param int $id
     * @param Carbon $outOfService
     * @return UserModel
     */
    public function updateExpireDate(int $id, Carbon $outOfService);
}
