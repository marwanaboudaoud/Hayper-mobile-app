<?php


namespace App\Src\Services\App\FileGenerator\Pdf\Contract;

use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;

class EmployeeContractOnePdfGenerator extends EmployeeContractPdfGenerator
{
    public function __construct(UserModel $userModel)
    {
        parent::__construct($userModel);

        $this->load('contract-1.pdf');
    }

    public function generateFirstPage()
    {

        $this->writeRows(28, 26, collect([
            $this->user->getInitialFullName(),
            $this->user->getBsn(),
            $this->address->getStreet() . ' ' . $this->address->getHouseNumber(),
            $this->address->getPostcode() . ' ' . $this->address->getCity(),
            'Nederland'
        ]));

        $this->writeColumn(37, 64.6, $this->getToday());
        $this->writeColumn(33, 87.2, $this->user->getFirstName() . ',');
        $this->writeColumn(128, 95.7, $this->getStartDate());
        $this->writeColumn(172, 95.7, $this->getRole());
        $this->writeColumn(161.2, 150.5, $this->getEndDate());
        $this->writeColumn(71, 209, $this->getRole() . '.');
    }

    public function generateSecondPage()
    {
        $this->writeColumn(118, 178.5, $this->user->getHourlyWage());
    }

    public function generateLastPage()
    {
        $this->writeColumn(137.5, 102.8, $this->getToday());
        $this->writeColumn(125.3, 140, $this->user->getInitialFullName());
        $this->writeColumn(24, 144, 'Directeur');
        $this->writeColumn(125.3, 144, $this->getRole());
    }

    public function generate()
    {
        $this->addPage();
        $this->generateFirstPage();

        $this->addPage();
        $this->generateSecondPage();

        $this->addPage();
        $this->addPage();
        $this->addPage();
        $this->generateLastPage();
    }
}
