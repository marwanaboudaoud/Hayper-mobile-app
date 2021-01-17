<?php


namespace App\Src\Mappers\Hyper\Subscription;

use App\HistorySubscription;
use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HistorySubscriptionEloquentMapper
{
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function (HistorySubscription $historySubscription) {
            return self::toModel($historySubscription);
        });
    }

    /**
     * @param HistorySubscription $historySubscription
     * @return HistorySubscriptionModel
     */
    public static function toModel(HistorySubscription $historySubscription): HistorySubscriptionModel
    {
        return (new HistorySubscriptionModel())
            ->setId($historySubscription->id)
            ->setTitle($historySubscription->title)
            ->setDurationInMonths($historySubscription->duration_in_months)
            ->setStartingDate(
                Carbon::parse($historySubscription->starting_date)
            )
            ->setGrossAmount($historySubscription->gross_amount)
            ->setReward($historySubscription->reward)
            ->setBonusCalc($historySubscription->is_bonus_calc)
            ->setBwCode($historySubscription->bw_code)
            ->setProjectId($historySubscription->project_id)
            ->setSubscriptionId($historySubscription->subscription_id)
            ->setActive($historySubscription->is_active)
            ->setActiveAt(
                Carbon::parse($historySubscription->active_at)
            );
    }
}
