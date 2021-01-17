<?php


namespace App\Src\Repositories\Hyper\Shift;

use App\Src\Models\Hyper\User\UserModel;

interface IMyShiftRepository
{
    public function count(string $token);
}
