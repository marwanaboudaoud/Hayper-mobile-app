<?php

namespace App\Http\Requests\Salary;

use App\Src\Mappers\Request\Salary\MySalaryRequestMapper;
use App\Src\Models\Hyper\Salary\MySalaryModel as MySalaryModelAlias;
use Illuminate\Foundation\Http\FormRequest;

class MySalaryRequest extends FormRequest
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
            'end_date' => 'required|date_format:"Y-m-d"',
        ];
    }

    /**
     * @return MySalaryModelAlias
     */
    public function map()
    {
        return MySalaryRequestMapper::toModel($this);
    }
}
