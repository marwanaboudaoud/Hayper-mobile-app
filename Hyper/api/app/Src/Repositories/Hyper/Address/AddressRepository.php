<?php


namespace App\Src\Repositories\Hyper\Address;

use App\Address;
use App\Src\Mappers\Hyper\Address\AddressEloquentMapper;
use App\Src\Mappers\Hyper\Address\AddressModelMapper;
use App\Src\Models\Hyper\Address\AddressModel;
use function Matrix\add;

class AddressRepository implements IAddressRepository
{
    /**
     * @param  AddressModel $addressModel
     * @return AddressModel
     */
    public function store(AddressModel $addressModel)
    {
        $address = AddressModelMapper::toEloquentModel($addressModel);
        $address->save();

        return AddressEloquentMapper::toAddressModel($address);
    }

    /**
     * @param  string $attr
     * @param  $arg
     * @return AddressModel|null
     */
    public function findBy(string $attr, $arg)
    {
        $address = Address::where($attr, $arg)->first();

        if (!$address) {
            return null;
        }

        return AddressEloquentMapper::toAddressModel($address);
    }

    /**
     * @param  int $id
     * @return AddressModel|null
     */
    public function findById(int $id)
    {
        return $this->findBy('id', $id);
    }

    public function update(int $id, AddressModel $addressModel)
    {
        $address = Address::findOrFail($id);
        $address->street = $addressModel->getStreet();
        $address->addition = $addressModel->getAddition();
        $address->postcode = $addressModel->getPostcode();
        $address->house_number = $addressModel->getHouseNumber();
        $address->city = $addressModel->getCity();
        $address->update();

        return AddressEloquentMapper::toAddressModel($address);
    }
}
