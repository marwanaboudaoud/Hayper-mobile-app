<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Exceptions\Schedule\ScheduledEmployeeException;
use App\Exceptions\Schedule\WeekNumberNotValidException;
use App\Exceptions\Schedule\YearNotValidException;
use App\Http\Requests\Schedule\EmployeeScheduleRequest;
use App\Schedule;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ScheduleService implements IScheduleService
{
    /**
     * @var IScheduleRepository
     */
    private $scheduleRepository;

    public function __construct(IScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param int $weekNr
     * @param int $year
     * @return Collection
     * @throws WeekNumberNotValidException
     * @throws YearNotValidException
     */
    public function get(int $weekNr, int $year)
    {
        $date = Carbon::createFromFormat('Y', $year);
        $firstWeekOfYear = 1;
        $lastWeekOfYear = $date->isoWeeksInYear();
        $firstYear = 2020;

        if ($weekNr < $firstWeekOfYear || $weekNr > $lastWeekOfYear) {
            throw new WeekNumberNotValidException($weekNr, $lastWeekOfYear);
        }

        if ($year < $firstYear) {
            throw new YearNotValidException();
        }

        $date->setISODate($year, $weekNr);

        $startDate = clone $date->startOfWeek();
        $endDate = clone $date->endOfWeek();

        return $this->scheduleRepository->get($startDate, $endDate);
    }

    /**
     * @param PaginationEmployeeScheduleModel $paginationEmployeeScheduleModel
     * @return mixed
     */
    public function getEmployeeSchedule(PaginationEmployeeScheduleModel $paginationEmployeeScheduleModel)
    {
        return $this->scheduleRepository->getEmployeeSchedule($paginationEmployeeScheduleModel);
    }
}
