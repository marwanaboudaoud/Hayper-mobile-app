<?php


namespace App\Src\Services\Hyper\Nationality;

use App\Src\Repositories\Hyper\Nationality\INationalityRepository;

class NationalityService implements INationalityService
{

    /**
     * @var INationalityRepository
     */
    private $nationalityRepository;

    public function __construct(INationalityRepository $nationalityRepository)
    {
        $this->nationalityRepository = $nationalityRepository;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->nationalityRepository->get();
    }
}
