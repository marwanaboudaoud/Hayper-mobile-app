<?php


namespace App\Src\Services\Hyper\Availability;

use App\Exceptions\Availability\DateExceededExpireDate;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use Carbon\Carbon;

class AvailabilityDateValidatorService implements IAvailabilityDateValidatorService
{
    /**
     * @param AvailabilityModel $availabilityModel
     * @throws DateExceededExpireDate
     */
    public function validate(AvailabilityModel $availabilityModel)
    {
        $expireDay = clone $availabilityModel->getDate();
        $expireDay->startOfWeek()
            ->addWeeks(-1)
            ->setTime(12, 0);

        $now = Carbon::now();

        if ($expireDay < $now) {
            throw new DateExceededExpireDate();
        }
    }
}
