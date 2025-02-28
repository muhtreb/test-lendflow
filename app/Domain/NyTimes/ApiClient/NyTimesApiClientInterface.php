<?php

namespace App\Domain\NyTimes\ApiClient;

use App\Domain\NyTimes\Query\BestSellersHistoryQuery;
use Illuminate\Http\Client\PendingRequest;

interface NyTimesApiClientInterface
{
    public function setNyTimesHttpClient(PendingRequest $client);
}
