<?php

namespace App\Domain\NyTimes\ApiClient;

use App\Domain\NyTimes\Exception\BestSellersHistoryErrorApiException;
use App\Domain\NyTimes\Exception\BestSellersHistoryUnauthenticatedApiException;
use App\Domain\NyTimes\Query\BestSellersHistoryQuery;

class BestSellersHistoryApiClient implements BestSellersHistoryApiClientInterface, NyTimesApiClientInterface
{
    use UseNyTimesHttpClientTrait;

    /**
     * @throws BestSellersHistoryErrorApiException
     * @throws BestSellersHistoryUnauthenticatedApiException
     */
    public function getBestSellersHistory(BestSellersHistoryQuery $params, int $limit = 20, int $offset = 0): array
    {
        $query = array_filter([
            'author' => $params->author,
            'title' => $params->title,
            'isbn' => $params->isbn,
            'offset' => $params->offset,
        ]);

        $response = $this->client->get('svc/books/v3/lists/best-sellers/history.json', $query);

        if ($response->failed()) {
            if ($response->status() === 401) {
                throw new BestSellersHistoryUnauthenticatedApiException();
            }

            throw new BestSellersHistoryErrorApiException();
        }

        return $response->json();
    }
}
