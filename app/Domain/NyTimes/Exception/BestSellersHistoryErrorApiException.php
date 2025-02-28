<?php

namespace App\Domain\NyTimes\Exception;

class BestSellersHistoryErrorApiException extends BestSellersHistoryApiException
{
    public function __construct()
    {
        parent::__construct('Failed to fetch best sellers history');
    }
}
