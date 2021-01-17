<?php

namespace Tests\Unit;

use App\Exceptions\Availability\DateExceededExpireDate;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Services\Hyper\Availability\AvailabilityDateValidatorService;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvailabilityDateValidatorServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testValidDate()
    {
        (new AvailabilityDateValidatorService())->validate((new AvailabilityModel())->setDate(Carbon::now()->addWeeks(2)));

        $this->assertTrue(true);
    }

    public function testInvalidDate()
    {
        $this->expectException(DateExceededExpireDate::class);

        (new AvailabilityDateValidatorService())->validate((new AvailabilityModel())->setDate(Carbon::now()));
    }
}
