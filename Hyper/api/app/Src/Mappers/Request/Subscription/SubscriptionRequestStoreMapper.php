<?php


namespace App\Src\Mappers\Request\Subscription;

use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use Carbon\Carbon;

class SubscriptionRequestStoreMapper
{
    /**
     * @param SubscriptionStoreRequest $request
     * @return SubscriptionModel
     */
    public static function toModel(SubscriptionStoreRequest $request)
    {
        return (new SubscriptionModel())
            ->setTitle($request->title)
            ->setGrossAmount($request->gross_amount)
            ->setDurationInMonths($request->duration_in_months)
            ->setStartingDate(
                Carbon::createFromFormat('Y-m-d', $request->starting_date)
            )
            ->setReward($request->reward)
            ->setBonusCalc($request->is_bonus_calc)
            ->setBwCode($request->bw_code)
            ->setProjectId($request->project_id);
    }
}
