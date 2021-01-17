<?php


namespace App\Src\Services\App\FileGenerator\Pdf\Contract;

use App\Src\Models\App\FileGenerator\Pdf\LineModel;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\App\FileGenerator\Pdf\PdfGeneratorService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class EmployeeContractPdfGenerator extends PdfGeneratorService
{
    /**
     * @var UserModel
     */
    protected $user;

    /**
     * @var Carbon
     */
    protected $today;

    /**
     * @var AddressModel
     */
    protected $address;

    /**
     * @var EmployeeContractModel
     */
    protected $contract;

    public function __construct(UserModel $userModel)
    {
        parent::__construct(Storage::disk('contract')->path(''));

        $this->user = $userModel;
        $this->address = $userModel->getAddress();
        $this->contract = $userModel->getEmployeeContract();
        $this->today = Carbon::now();
    }

    /**
     * @return string
     */
    protected function getToday()
    {
        return $this->today->format('d-m-Y');
    }

    /**
     * @return string
     */
    protected function getStartDate()
    {
        return $this->contract->getStartDate()->format('d-m-Y');
    }

    /**
     * @return string
     */
    protected function getEndDate()
    {
        return $this->contract->getEndDate()->format('d-m-Y');
    }

    /**
     * @return string|null
     */
    protected function getRole()
    {
        return $this->user->getRole()->getTitle();
    }

    protected function writeRows(float $initX, float $initY, Collection $collection)
    {
        $this->setXy($initX, $initY);

        $collection->each(function (string $text) {
            $this->writeLine($text);
            $this->newRow();
        });
    }

    protected function writeColumn(float $x, float $y, string $text)
    {
        $this->setXy($x, $y);
        $this->writeLine($text);
    }
}
