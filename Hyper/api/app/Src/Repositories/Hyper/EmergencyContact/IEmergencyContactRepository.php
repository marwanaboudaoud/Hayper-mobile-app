<?php


namespace App\Src\Repositories\Hyper\EmergencyContact;

use App\EmergencyContact;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;

interface IEmergencyContactRepository
{
    public function store(EmergencyContactModel $emergencyContactModel);

    public function findById(int $getId);

    public function findBy(string $attr, $arg);

    public function update(int $id, EmergencyContactModel $emergencyContact);
}
