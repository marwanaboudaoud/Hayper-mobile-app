<?php

namespace App\Console\Commands;

use App\Src\Repositories\App\Financial\IFinancialCloseRepository;
use App\Src\Services\App\FinancialClosing\IFinancialClosingService;
use App\Src\Services\App\FinancialClosing\IMonthClosingService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close month';

    /**
     * @var IMonthClosingService
     */
    private $monthClosingService;

    /**
     * Create a new command instance.
     *
     * @param IMonthClosingService $monthClosingService
     */
    public function __construct(IMonthClosingService $monthClosingService)
    {
        $this->monthClosingService = $monthClosingService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now();

        $this->monthClosingService->setMonth($date->month)->setYear($date->year)->close();
    }
}
