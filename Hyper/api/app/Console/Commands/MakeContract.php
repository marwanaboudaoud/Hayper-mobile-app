<?php

namespace App\Console\Commands;

use App\Src\Repositories\Hyper\User\UserRepository;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractOnePdfGenerator;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractThreePdfGenerator;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractTwoPdfGenerator;
use App\Src\Services\App\FileGenerator\Pdf\PdfGeneratorService;
use Illuminate\Console\Command;

class MakeContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a employee contract!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     */
    public function handle()
    {
        $repo = (new UserRepository());
        $user = $repo->findById(1);
        $user->setBsn('12345');

        try {
            (new EmployeeContractThreePdfGenerator($user))->save();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
