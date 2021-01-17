<?php

namespace App\Http\Requests\Schedule;

use App\Src\Mappers\Request\Schedule\ScheduleRequestStoreMapper;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleStoreRequest extends FormRequest
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
            'items' => 'required|array',
            'items.*.project_id' => 'required|int',
            'items.*.date' => 'required|date',
            'items.*.address' => 'required|string',
            'items.*.postcode' => 'required|string',
            'items.*.city' => 'required|string',
            'items.*.employees' => 'required|array',
            'items.*.employees.*' => 'required|int',
            'items.*.driver' => 'required|int',
            'items.*.availability_shift_id' => 'required|int'
        ];
    }

    public function map()
    {
        return ScheduleRequestStoreMapper::toCollectionModel($this);
    }
}
