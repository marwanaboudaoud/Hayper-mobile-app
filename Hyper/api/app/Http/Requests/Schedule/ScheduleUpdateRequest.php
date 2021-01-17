<?php

namespace App\Http\Requests\Schedule;

use App\Src\Mappers\Request\Schedule\ScheduleRequestUpdateMapper;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleUpdateRequest extends FormRequest
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
            'date' => 'required|date',
            'address' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
            'employees' => 'required|array',
            'employees.*' => 'required|int',
            'project_id' => 'required|int',
            'driver' => 'required|int',
            'availability_shift_id' => 'required|int'
        ];
    }

    /**
     * @return ScheduleModel
     */
    public function map()
    {
        return ScheduleRequestUpdateMapper::toModel($this);
    }
}
