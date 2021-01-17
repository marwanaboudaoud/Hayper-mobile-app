<?php

namespace Tests\Unit;

use App\Exceptions\FinancialClosing\MonthNotValidException;
use App\Exceptions\FinancialClosing\YearNotValidException;
use App\Src\Validators\App\FinancialClosing\MonthClosingValidator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonthClosingValidatorTest extends TestCase
{
    public function testValidMonth()
    {
        MonthClosingValidator::validateMonth(5);

        $this->assertTrue(true);
    }

    public function testMinBoundaryMonth()
    {
        MonthClosingValidator::validateMonth(1);

        $this->assertTrue(true);
    }

    public function testOverMinBoundaryMonth()
    {
        $this->expectException(MonthNotValidException::class);

        MonthClosingValidator::validateMonth(0);


    }

    public function testMaxBoundaryMonth()
    {
        MonthClosingValidator::validateMonth(12);

        $this->assertTrue(true);
    }

    public function testOverMaxBoundaryMonth()
    {
        $this->expectException(MonthNotValidException::class);

        MonthClosingValidator::validateMonth(13);
    }

    public function testValidYearValidMonth()
    {
        MonthClosingValidator::validate(1,2020);

        $this->assertTrue(true);
    }

    public function testValidYearInvalidMonth()
    {
        $this->expectException(MonthNotValidException::class);

        MonthClosingValidator::validate(0,2020);
    }

    public function testInvalidYearValidMonth()
    {
        $this->expectException(YearNotValidException::class);

        MonthClosingValidator::validate(1,2019);
    }
}
