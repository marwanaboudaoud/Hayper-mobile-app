<?php


namespace App\Src\Mappers\Hyper\EmergencyContact;

use App\EmergencyContact;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;

class EmergencyContactEloquentMapper
{
    public static function toEmergencyContactModel(EmergencyContact $emergencyContact)
    {
        return (new EmergencyContactModel())
            ->setId($emergencyContact->id)
            ->setFirstName($emergencyContact->first_name)
            ->setLastName($emergencyContact->last_name)
            ->setPhone($emergencyContact->phone)
            ->setRelationship($emergencyContact->relationship)
            ->setUser($emergencyContact->user_id);
    }
}
