<?php


namespace App\Src\Mappers\Hyper\Employee;

class EmployeeExportMapper
{
    public static function toArray($row)
    {
        return [
            $row->id,
            $row->alias,
            $row->first_name,
            $row->insertion . ' ' . $row->last_name,
            $row->email,
            $row->role_title,
            'Amsterdam',
            boolval($row->has_drivers_license) ? 'Ja' : 'Nee',
            $row->into_service_date,
            $row->end_date_contract
        ];
    }
}
