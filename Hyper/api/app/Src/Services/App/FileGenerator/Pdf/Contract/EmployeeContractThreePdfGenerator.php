<?php


namespace App\Src\Services\App\FileGenerator\Pdf\Contract;

use App\Src\Models\Hyper\User\UserModel;

class EmployeeContractThreePdfGenerator extends EmployeeContractPdfGenerator
{
    public function __construct(UserModel $userModel)
    {
        parent::__construct($userModel);

        $this->load('contract-3.pdf');
    }

    public function generateFirstPage()
    {
        $this->writeRows(26, 26, collect([
            $this->user->getInitialFullName(),
            $this->user->getBsn(),
            $this->address->getStreet() . ' ' . $this->address->getHouseNumber(),
            $this->address->getPostcode() . ' ' . $this->address->getCity(),
            'Nederland'
        ]));

        $this->writeColumn(37, 64.5, $this->getToday());
        $this->writeColumn(33, 82, $this->user->getFirstName() . ',');
        $this->writeColumn(133, 94, $this->getStartDate());
        $this->writeColumn(29.5, 98.3, $this->getRole());
        $this->writeColumn(175.5, 146.5, $this->getEndDate());
        $this->writeColumn(71, 199, $this->getRole() . '.');
    }

    public function generateSecondPage()
    {
        $this->writeColumn(118, 164, $this->user->getHourlyWage());
    }

    private function generateThirdPage()
    {
        $this->writeColumn(113, 228.6, $this->getRole());
    }

    public function generateLastPage()
    {
        $this->writeColumn(137.5, 99.8, $this->getToday());
        $this->writeColumn(125.3, 138, $this->user->getInitialFullName());
        $this->writeColumn(24, 144.5, 'Directeur');
        $this->writeColumn(125.3, 144.5, $this->getRole());
    }

    public function generate()
    {
        $this->addPage();
        $this->generateFirstPage();

        $this->addPage();
        $this->generateSecondPage();

        $this->addPage();
        $this->generateThirdPage();

        $this->addPage();
        $this->addPage();
        $this->generateLastPage();
    }
}
