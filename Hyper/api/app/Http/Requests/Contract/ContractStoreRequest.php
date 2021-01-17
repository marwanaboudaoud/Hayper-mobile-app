<?php

namespace App\Http\Requests\Contract;

use App\Src\Mappers\Request\Employee\ContractRequestStoreMapper;
use Illuminate\Foundation\Http\FormRequest;

class ContractStoreRequest extends FormRequest
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
            'start_date' => 'required|date_format:"Y-m-d"',
            'end_date' => 'nullable|date_format:"Y-m-d"',
            'trial_per_day' => 'required|int',
            'user' => 'required|int',
            'document_number' => 'required|string'
        ];
    }

    public function map()
    {
        return ContractRequestStoreMapper::toEmployeeContractModel($this);
    }
}
