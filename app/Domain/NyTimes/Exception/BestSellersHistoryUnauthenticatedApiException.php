<?php

namespace App\Domain\NyTimes\Exception;

class BestSellersHistoryUnauthenticatedApiException extends BestSellersHistoryApiException
{
    public function __construct()
    {
        parent::__construct('Failed to authenticate with the best sellers history API');
    }
}
