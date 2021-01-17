<?php


namespace App\Src\Mappers\Hyper\Subscription;

use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SubscriptionEloquentModelMapper
{
    public static function toModel(Subscription $subscription)
    {
        return (new SubscriptionModel())
            ->setId($subscription->id)
            ->setTitle($subscription->title)
            ->setGrossAmount($subscription->gross_amount)
            ->setDurationInMonths($subscription->duration_in_months)
            ->setStartingDate(
                Carbon::createFromFormat('Y-m-d', $subscription->starting_date)
            )
            ->setReward($subscription->reward)
            ->setBonusCalc($subscription->is_bonus_calc)
            ->setBwCode($subscription->bw_code)
            ->setProjectId($subscription->project_id)
            ->setProject(
                ProjectEloquentMapper::toModel($subscription->project)
            );
    }

    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function (Subscription $item) {
            return self::toModel($item);
        });
    }
}
