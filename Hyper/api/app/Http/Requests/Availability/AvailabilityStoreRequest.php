<?php

namespace App\Http\Requests\Availability;

use App\Src\Mappers\Request\Availability\AvailabilityStoreRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class AvailabilityStoreRequest extends FormRequest
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
            'is_present' => 'required|boolean',
            'availability_shift_id' => 'required_if:is_present,1|int'
        ];
    }

    public function map()
    {
        return AvailabilityStoreRequestMapper::toModel($this);
    }
}
