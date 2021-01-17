<?php


namespace App\Src\Services\Hyper\Gender;

use App\Src\Repositories\Hyper\Gender\IGenderRepository;

class GenderService implements IGenderService
{

    /**
     * @var IGenderRepository
     */
    private $genderService;

    public function __construct(IGenderRepository $genderRepository)
    {
        $this->genderService = $genderRepository;
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        return $this->genderService->get();
    }
}
