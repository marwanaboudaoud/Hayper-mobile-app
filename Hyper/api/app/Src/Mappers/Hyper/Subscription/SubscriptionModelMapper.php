<?php


namespace App\Src\Mappers\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Subscription;
use Illuminate\Support\Collection;

class SubscriptionModelMapper
{
    /**
     * @param SubscriptionModel $subscriptionModel
     * @return Subscription
     */
    public static function toEloquentModel(SubscriptionModel $subscriptionModel)
    {
        $model = new Subscription();
        $model->id = $subscriptionModel->getId();
        $model->title = $subscriptionModel->getTitle();
        $model->gross_amount = $subscriptionModel->getGrossAmount();
        $model->duration_in_months = $subscriptionModel->getDurationInMonths();
        $model->starting_date = $subscriptionModel->getStartingDate()->toDateString();
        $model->reward = $subscriptionModel->getReward();
        $model->is_bonus_calc = $subscriptionModel->isBonusCalc();
        $model->bw_code = $subscriptionModel->getBwCode();
        $model->project_id = $subscriptionModel->getProjectId();

        return $model;
    }

    /**
     * @param SubscriptionModel $subscriptionModel
     * @return array
     */
    public static function toArray(SubscriptionModel $subscriptionModel)
    {
        return [
            'id' => $subscriptionModel->getId(),
            'title' => $subscriptionModel->getTitle(),
            'gross_amount' => $subscriptionModel->getGrossAmount(),
            'duration_in_months' => $subscriptionModel->getDurationInMonths(),
            'starting_date' => $subscriptionModel->getStartingDate()->toDateString(),
            'reward' => $subscriptionModel->getReward(),
            'is_bonus_calc' => $subscriptionModel->isBonusCalc(),
            'bw_code' => $subscriptionModel->getBwCode(),
            'project_id' => $subscriptionModel->getProjectId(),
            'project_name' => $subscriptionModel->getProject()->getName()
        ];
    }

    public static function toEloquentUpdateModel(SubscriptionModel $oldModel, SubscriptionModel $subscriptionModel)
    {
        $model = new Subscription();
        $model->id = $oldModel->getId();
        $model->title = $subscriptionModel->getTitle() ?? $oldModel->getTitle();
        $model->gross_amount = $subscriptionModel->getGrossAmount() ?? $oldModel->getGrossAmount();
        $model->duration_in_months = $subscriptionModel->getDurationInMonths() ?? $oldModel->getDurationInMonths();
        $model->starting_date = $subscriptionModel->getStartingDate()->toDateString() ??
            $oldModel->getStartingDate()->toDateString();
        $model->reward = $subscriptionModel->getReward() ?? $oldModel->getReward();
        $model->is_bonus_calc = $subscriptionModel->isBonusCalc() ?? $oldModel->isBonusCalc();
        $model->bw_code = $subscriptionModel->getBwCode() ?? $oldModel->getBwCode();
        $model->project_id = $subscriptionModel->getProjectId() ?? $oldModel->getProjectId();
        $model->exists = true;

        return $model;
    }

    /**
     * @param Collection $collection
     * @return array
     */
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (SubscriptionModel $model) {
            return self::toArray($model);
        })->toArray();
    }

    /**
     * @param SubscriptionModel $subscriptionModel
     * @return HistorySubscriptionModel
     */
    public static function toHistorySubscriptionModel(SubscriptionModel $subscriptionModel)
    {
        return (new HistorySubscriptionModel())
            ->setTitle($subscriptionModel->getTitle())
            ->setDurationInMonths($subscriptionModel->getDurationInMonths())
            ->setStartingDate($subscriptionModel->getStartingDate())
            ->setReward($subscriptionModel->getReward())
            ->setGrossAmount($subscriptionModel->getGrossAmount())
            ->setBonusCalc($subscriptionModel->isBonusCalc())
            ->setBwCode($subscriptionModel->getBwCode())
            ->setProjectId($subscriptionModel->getProjectId())
            ->setProject($subscriptionModel->getProject())
            ->setSubscriptionId($subscriptionModel->getId());
    }
}
