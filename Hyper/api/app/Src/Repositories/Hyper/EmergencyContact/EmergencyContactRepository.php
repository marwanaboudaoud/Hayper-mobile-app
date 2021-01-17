<?php


namespace App\Src\Repositories\Hyper\EmergencyContact;

use App\EmergencyContact;
use App\Src\Mappers\Hyper\EmergencyContact\EmergencyContactEloquentMapper;
use App\Src\Mappers\Hyper\EmergencyContact\EmergencyContactModelMapper;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;

class EmergencyContactRepository implements IEmergencyContactRepository
{
    /**
     * @param  EmergencyContactModel $emergencyContactModel
     * @return EmergencyContactModel
     */
    public function store(EmergencyContactModel $emergencyContactModel)
    {
        $emergencyContact = EmergencyContactModelMapper::toEloquentModel($emergencyContactModel);
        $emergencyContact->save();

        return EmergencyContactEloquentMapper::toEmergencyContactModel($emergencyContact);
    }

    /**
     * @param  int $id
     * @return EmergencyContactModel|null
     */
    public function findById(int $id)
    {
        return $this->findBy('id', $id);
    }

    /**
     * @param  string $attr
     * @param  $arg
     * @return EmergencyContactModel|null
     */
    public function findBy(string $attr, $arg)
    {
        $contact = EmergencyContact::where($attr, $arg)->first();

        if (!$contact) {
            return null;
        }

        return EmergencyContactEloquentMapper::toEmergencyContactModel($contact);
    }

    /**
     * @param  int                   $id
     * @param  EmergencyContactModel $emergencyContact
     * @return EmergencyContactModel
     */
    public function update(int $id, EmergencyContactModel $emergencyContact)
    {
        $contact = EmergencyContact::findOrFail($id);
        $contact->first_name = $emergencyContact->getFirstName();
        $contact->last_name = $emergencyContact->getLastName();
        $contact->phone = $emergencyContact->getPhone();
        $contact->relationship = $emergencyContact->getRelationship();
        $contact->update();

        return EmergencyContactEloquentMapper::toEmergencyContactModel($contact);
    }
}
