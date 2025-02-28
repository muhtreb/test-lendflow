<?php

namespace App\Domain\NyTimes\ApiClient;

use App\Domain\NyTimes\Query\BestSellersHistoryQuery;
use Illuminate\Http\Client\PendingRequest;

interface BestSellersHistoryApiClientInterface
{
    public function getBestSellersHistory(BestSellersHistoryQuery $params): array;
}
