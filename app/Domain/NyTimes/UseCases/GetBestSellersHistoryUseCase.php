<?php

namespace App\Domain\NyTimes\UseCases;

use App\Domain\NyTimes\ApiClient\BestSellersHistoryApiClientInterface;
use App\Domain\NyTimes\Exception\BestSellersHistoryApiException;
use App\Domain\NyTimes\Exception\BestSellersHistoryErrorApiException;
use App\Domain\NyTimes\Query\BestSellersHistoryQuery;
use Illuminate\Support\Facades\Log;

readonly class GetBestSellersHistoryUseCase
{
    public function __construct(
        private BestSellersHistoryApiClientInterface $apiClient
    ) {
    }

    public function execute(array $params): array
    {
        $bestSellersHistoryQuery = new BestSellersHistoryQuery(
            author: $params['author'] ?? null,
            title: $params['title'] ?? null,
            isbn: $params['isbn'] ?? null,
            offset: $params['offset'] ?? null
        );

        try {
            return $this->apiClient->getBestSellersHistory($bestSellersHistoryQuery);
        } catch (BestSellersHistoryApiException $e) {
            Log::error($e);
            throw $e;
        }
    }
}
