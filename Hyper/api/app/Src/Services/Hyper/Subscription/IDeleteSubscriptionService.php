<?php


namespace App\Src\Services\Hyper\Subscription;

interface IDeleteSubscriptionService
{
    /**
     * @param int $id
     * @return boolean
     */
    public function delete(int $id);
}
