<?php


namespace App\Src\Mappers\Hyper\EmergencyContact;

use App\EmergencyContact;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;

class EmergencyContactModelMapper
{
    public static function toArray(?EmergencyContactModel $emergencyContactModel)
    {
        return $emergencyContactModel ? [
            'id' => $emergencyContactModel->getId(),
            'first_name' => $emergencyContactModel->getFirstName(),
            'last_name' => $emergencyContactModel->getLastName(),
            'phone' => $emergencyContactModel->getPhone(),
            'relationship' => $emergencyContactModel->getRelationship(),
            'user_id' => $emergencyContactModel->getUser()
        ] : [];
    }

    public static function toEloquentModel(EmergencyContactModel $emergency)
    {
        $emergencyContactModel = new EmergencyContact();
        $emergencyContactModel->id = $emergency->getId();
        $emergencyContactModel->first_name = $emergency->getFirstName();
        $emergencyContactModel->last_name = $emergency->getLastName();
        $emergencyContactModel->phone = $emergency->getPhone();
        $emergencyContactModel->relationship = $emergency->getRelationship();
        $emergencyContactModel->user_id = $emergency->getUser();

        return $emergencyContactModel;
    }
}
