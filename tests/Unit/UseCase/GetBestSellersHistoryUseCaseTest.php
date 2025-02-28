<?php

use App\Domain\NyTimes\ApiClient\BestSellersHistoryApiClientInterface;
use App\Domain\NyTimes\UseCases\GetBestSellersHistoryUseCase;
use App\Domain\NyTimes\Query\BestSellersHistoryQuery;

test('it should call api client with parameters', function () {
    $useCaseParams = [
        'title' => 'Harry Potter',
        'author' => 'J.K. Rowling',
        'isbn' => '9780439139601',
        'offset' => 0,
    ];

    $apiClient = Mockery::mock(BestSellersHistoryApiClientInterface::class);
    $apiClient->shouldReceive('getBestSellersHistory')
        ->once()
        ->with(Mockery::on(function ($query) use ($useCaseParams) {
            return $query instanceof BestSellersHistoryQuery &&
                $query->title === $useCaseParams['title'] &&
                $query->author === $useCaseParams['author'] &&
                $query->isbn === $useCaseParams['isbn'] &&
                $query->offset === $useCaseParams['offset'];
        }))
        ->andReturn([]);

    $useCase = new GetBestSellersHistoryUseCase($apiClient);

    $useCase->execute($useCaseParams);
});
