<?php

namespace App\Src\Services\Hyper\Salary;

use App\Src\Models\Hyper\Salary\MySalaryModel;

interface IMySalaryService
{
    public function get(MySalaryModel $mySalaryModel);
}
