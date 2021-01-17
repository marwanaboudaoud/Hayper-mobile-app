<?php


namespace App\Src\Repositories\Hyper\Country;

use App\Country;
use App\Src\Mappers\Hyper\Country\CountryEloquentMapper;

class CountryRepository implements ICountryRepository
{
    /**
     * @return \Illuminate\Support\Collection|mixed
     */
    public function get()
    {
        $countries = Country::orderBy('country', 'asc')->get();
        return CountryEloquentMapper::toCollection($countries);
    }
}
