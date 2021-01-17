<?php

namespace App\Http\Requests\Employee;

use App\Src\Mappers\Request\Employee\EmployeeActivateRequestMapper;
use App\Src\Models\Hyper\Employee\EmployeeActivateModel;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeActivateRequest extends FormRequest
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
            'password' => 'required|confirmed',
            'token' => 'required'
        ];
    }

    /**
     * @return EmployeeActivateModel
     */
    public function map()
    {
        return EmployeeActivateRequestMapper::toModel($this);
    }
}
