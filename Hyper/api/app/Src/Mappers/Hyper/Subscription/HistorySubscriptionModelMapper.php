<?php


namespace App\Src\Mappers\Hyper\Subscription;

use App\HistorySubscription;
use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use Carbon\Carbon;

class HistorySubscriptionModelMapper
{
    /**
     * @param HistorySubscriptionModel $historySubscriptionModel
     * @return HistorySubscription
     */
    public static function toEloquentModel(HistorySubscriptionModel $historySubscriptionModel)
    {
//        dd($historySubscriptionModel->getGrossAmount());
        $model = new HistorySubscription();
        $model->id = $historySubscriptionModel->getId();
        $model->title = $historySubscriptionModel->getTitle();
        $model->duration_in_months = $historySubscriptionModel->getDurationInMonths();
        $model->starting_date = $historySubscriptionModel->getStartingDate()->toDateTimeString();
        $model->gross_amount = $historySubscriptionModel->getGrossAmount();
        $model->reward = $historySubscriptionModel->getReward();
        $model->is_bonus_calc = $historySubscriptionModel->isBonusCalc();
        $model->bw_code = $historySubscriptionModel->getBwCode();
        $model->subscription_id = $historySubscriptionModel->getSubscriptionId();
        $model->project_id = $historySubscriptionModel->getProjectId();
        $model->is_active = $historySubscriptionModel->isActive();
        $model->active_at = $historySubscriptionModel->getActiveAt()->toDateString();

        return $model;
    }

    /**
     * @param HistorySubscriptionModel $historySubscriptionModel
     * @return HistorySubscription
     */
    public static function toEloquentUpdateModel(HistorySubscriptionModel $historySubscriptionModel)
    {

        $model = self::toEloquentModel($historySubscriptionModel);
        $model->exists = true;

        return $model;
    }
}
