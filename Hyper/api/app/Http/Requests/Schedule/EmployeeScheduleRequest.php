<?php

namespace App\Http\Requests\Schedule;

use App\Http\Requests\Pagination\PaginationRequest;
use App\Src\Mappers\Request\Employee\EmployeeScheduleRequestSearchMapper;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeScheduleRequest extends FormRequest
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
            'start_date' => 'date',
            'end_date' => 'date'
        ];
    }

    /**
     * @return \App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel|mixed
     */
    public function map()
    {
        return EmployeeScheduleRequestSearchMapper::toModel($this);
    }
}
