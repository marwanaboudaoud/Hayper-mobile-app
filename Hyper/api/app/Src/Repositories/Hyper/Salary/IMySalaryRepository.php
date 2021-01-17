<?php

namespace App\Src\Repositories\Hyper\Salary;

use App\Src\Models\Hyper\Salary\MySalaryModel;

interface IMySalaryRepository
{
    public function get(MySalaryModel $mySalaryModel);
}
