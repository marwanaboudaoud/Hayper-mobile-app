<?php


namespace App\Src\Services\App\FinancialClosing;

use App\Exceptions\FinancialClosing\MonthNotValidException;
use App\Exceptions\FinancialClosing\YearNotValidException;
use App\Exceptions\Schedule\WeekNumberNotValidException;
use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Repositories\App\Financial\IFinancialCloseRepository;
use App\Src\Repositories\App\Financial\IFinancialOpenRepository;
use App\Src\Services\App\FinancialOpening\IFinancialOpenService;
use App\Src\Validators\App\FinancialClosing\MonthClosingValidator;
use Carbon\Carbon;

class MonthClosingService implements IMonthClosingService
{
    /**
     * @var IFinancialCloseRepository
     */
    private $financialCloseRepository;

    /**
     * @var IFinancialOpenService
     */
    private $financialOpenService;

    /**
     * @var int
     */
    private $month;

    /**
     * @var int
     */
    private $year;

    /**
     * MonthClosingService constructor.
     * @param IFinancialCloseRepository $financialCloseRepository
     * @param IFinancialOpenService $financialOpenService
     */
    public function __construct(
        IFinancialCloseRepository $financialCloseRepository,
        IFinancialOpenService $financialOpenService
    ) {
        $this->financialCloseRepository = $financialCloseRepository;
        $this->financialOpenService = $financialOpenService;
    }


    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @param int $month
     * @return MonthClosingService
     */
    public function setMonth(int $month): IMonthClosingService
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return MonthClosingService
     */
    public function setYear(int $year): IMonthClosingService
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @throws MonthNotValidException
     * @throws YearNotValidException
     */
    public function close()
    {
        $month = $this->getMonth();
        $year = $this->getYear();
        $ym = $year . '-' . $month;

        MonthClosingValidator::validate($month, $year);

        $date = Carbon::createFromFormat('Y-m', $ym);
        $result = $this->financialCloseRepository->close($date);
        $this->financialOpenService->storeCollection($result);
    }
}
