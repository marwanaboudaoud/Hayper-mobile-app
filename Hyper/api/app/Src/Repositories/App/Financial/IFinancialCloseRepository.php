<?php


namespace App\Src\Repositories\App\Financial;

use Carbon\Carbon;

interface IFinancialCloseRepository
{
    /**
     * @param Carbon $date
     * @return mixed
     */
    public function close(Carbon $date);
}
