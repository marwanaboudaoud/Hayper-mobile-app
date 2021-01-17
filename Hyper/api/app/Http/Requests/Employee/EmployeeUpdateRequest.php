<?php

namespace App\Http\Requests\Employee;

use App\Src\Mappers\Request\Employee\EmployeeRequestStoreMapper;
use App\Src\Mappers\Request\Employee\EmployeeRequestUpdateMapper;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alias' => 'required|string',
            'initials' => 'required|string',
            'first_name' => 'required|string',
            'insertion' => 'string|nullable',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'gender_id' => 'required|int',
            'has_drivers_license' => 'required|bool',
            'date_of_birth' => 'date',
            'country_of_birth_id' => 'required|int',
            'nationality_id' => 'required|int',
            'marital_status_id' => 'required|int',
            'iban' => 'required|string',
            'role' => 'required|int',
            'income_tax' => 'required|bool',
            'address.id' => 'required|int',
            'address.street' => 'required|string',
            'address.house_number' => 'required|int',
            'address.house_number_addition' => 'string',
            'address.postcode' => 'required|string',
            'address.city' => 'required|string',
            'emergency_contact.id' => 'required|int',
            'emergency_contact.first_name' => 'required|string',
            'emergency_contact.last_name' => 'required|string',
            'emergency_contact.phone' => 'required|string',
            'emergency_contact.relationship' => 'required|string',
            'contract.document_number' => 'required|string',
//            'contract.expiration_date' => 'required|date_format:Y-m-d',
            'works_on_project' => 'array'
        ];
    }

    public function map()
    {
        return EmployeeRequestUpdateMapper::toUserModel($this);
    }
}
