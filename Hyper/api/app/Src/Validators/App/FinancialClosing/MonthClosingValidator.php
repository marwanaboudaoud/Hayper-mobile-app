<?php


namespace App\Src\Validators\App\FinancialClosing;

use App\Exceptions\FinancialClosing\MonthNotValidException;
use App\Exceptions\FinancialClosing\YearNotValidException;

class MonthClosingValidator
{
    /**
     * @param int $month
     * @param int $year
     * @throws MonthNotValidException
     * @throws YearNotValidException
     */
    public static function validate(int $month, int $year)
    {
        self::validateMonth($month);
        self::validateYear($year);
    }

    public static function validateMonth(int $month)
    {
        $firstMonth = 1;
        $lastMonth = 12;

        if (!$month || $month < $firstMonth || $month > $lastMonth) {
            throw new MonthNotValidException();
        }
    }

    public static function validateYear(int $year)
    {
        $firstYear = 2020;

        if (!$year || $year < $firstYear) {
            throw new YearNotValidException();
        }
    }
}
