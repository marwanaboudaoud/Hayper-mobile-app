<?php

namespace App\Http\Requests\Contract;

use App\Src\Mappers\Request\Contract\EmployeeContractRequestMapper;
use App\Src\Mappers\Request\Employee\ContractRequestStoreMapper;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeContractRequest extends FormRequest
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
            'contract_id' => 'required|int'
        ];
    }

    public function map()
    {
        return EmployeeContractRequestMapper::toModel($this);
    }
}
