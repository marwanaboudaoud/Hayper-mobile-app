<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Salary\SalaryRequestSearchMapper;
use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use Illuminate\Foundation\Http\FormRequest;

class SalaryPaginationRequest extends PaginationRequest
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
        $rules = [
            'id' => 'int',
            'employee_name' => 'string',
            'date' => 'string',
            'heading' => 'string',
            'description' => 'string',
            'price' => 'float',
            'filter.month' => 'int',
            'filter.year' => 'int',
            'salary' => 'string'
        ];

        return array_merge(parent::rules(), $rules);
    }

    /**
     * @return SalaryPaginationModel
     */
    public function map()
    {
        return SalaryRequestSearchMapper::toPaginationModel($this);
    }
}
