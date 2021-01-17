<?php


namespace App\Src\Services\Hyper\Country;

use App\Src\Repositories\Hyper\Country\ICountryRepository;

class CountryService implements ICountryService
{

    /**
     * @var ICountryRepository
     */
    private $countryRepository;

    /**
     * CountryService constructor.
     * @param ICountryRepository $countryRepository
     */
    public function __construct(ICountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->countryRepository->get();
    }
}
