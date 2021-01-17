<?php

namespace App\Http\Requests\Salary;

use App\Src\Mappers\Hyper\Salary\SalaryManualModelMapper;
use App\Src\Mappers\Request\Salary\SalaryManualStoreRequestMapper;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryManualModel;
use Illuminate\Foundation\Http\FormRequest;

class SalaryManualStoreRequest extends FormRequest
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
            'date' => 'required|date_format:"Y-m-d"',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ];
    }

    /**
     * @return SalaryDayModel
     */
    public function map()
    {
        return SalaryManualModelMapper::toSalaryDayModel(
            SalaryManualStoreRequestMapper::toModel($this)
        );
    }
}
