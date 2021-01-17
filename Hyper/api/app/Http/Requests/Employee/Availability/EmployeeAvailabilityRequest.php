<?php

namespace App\Http\Requests\Employee\Availability;

use App\Src\Mappers\Request\Employee\Availability\EmployeeAvailabilityRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeAvailabilityRequest extends FormRequest
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

    public function map()
    {
        return EmployeeAvailabilityRequestMapper::toModel($this);
    }
}
