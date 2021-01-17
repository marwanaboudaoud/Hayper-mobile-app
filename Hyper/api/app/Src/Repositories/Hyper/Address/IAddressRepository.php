<?php


namespace App\Src\Repositories\Hyper\Address;

use App\Address;
use App\Src\Models\Hyper\Address\AddressModel;

interface IAddressRepository
{
    public function store(AddressModel $addressModel);

    public function findBy(string $attr, $arg);

    public function findById(int $id);

    public function update(int $id, AddressModel $address);
}
