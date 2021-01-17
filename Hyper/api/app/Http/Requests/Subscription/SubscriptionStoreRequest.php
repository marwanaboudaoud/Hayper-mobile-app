<?php

namespace App\Http\Requests\Subscription;

use App\Src\Mappers\Request\Subscription\SubscriptionRequestStoreMapper;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'gross_amount' => 'required|numeric',
            'duration_in_months' => 'required|int',
            'starting_date' => 'required|date_format:"Y-m-d"',
            'reward' => 'required|numeric',
            'is_bonus_calc' => 'required|bool',
            'bw_code' => 'required|string',
            'project_id' => 'required|int'
        ];
    }


    public function toModel()
    {
        return SubscriptionRequestStoreMapper::toModel($this);
    }
}
