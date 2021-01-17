<?php

namespace App\Http\Requests\Contract;

use App\Src\Mappers\Request\Contract\EmployeeContractActionRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeContractActionRequest extends FormRequest
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
            'is_extended' => 'required|bool',
            'contract_id' => 'required|int'
        ];
    }

    /**
     * @return mixed
     */
    public function map()
    {
        return EmployeeContractActionRequestMapper::toModel($this);
    }
}
