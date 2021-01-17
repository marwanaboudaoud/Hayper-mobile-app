<?php


namespace App\Src\Services\App\FinancialClosing;

interface IMonthClosingService extends IFinancialClosingService
{
    public function setMonth(int $month): IMonthClosingService;

    public function setYear(int $year): IMonthClosingService;
}
