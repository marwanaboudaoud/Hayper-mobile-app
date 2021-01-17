<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Employee\EmployeeRequestSearchMapper;
use Illuminate\Foundation\Http\FormRequest;

class EmployeePaginationRequest extends FormRequest
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
            'alias' => 'string',
            'initials' => 'string',
            'first_name' => 'string',
            'insertion' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'phone' => 'string',
            'gender_id' => 'int',
            'has_drivers_license' => 'bool',
            'date_of_birth' => 'date',
            'country_of_birth_id' => 'int',
            'nationality_id' => 'int',
            'marital_status_id' => 'int',
            'bsn' => 'int',
            'iban' => 'string',
            'income_tax' => 'bool',
            'role_title' => 'string',
        ];
    }

    public function map()
    {
        return EmployeeRequestSearchMapper::toEmployeeModel($this);
    }
}
