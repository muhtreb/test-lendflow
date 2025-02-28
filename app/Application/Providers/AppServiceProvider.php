<?php

namespace App\Application\Providers;

use App\Domain\NyTimes\ApiClient\BestSellersHistoryApiClient;
use App\Domain\NyTimes\ApiClient\BestSellersHistoryApiClientInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('testing')) {
            Http::preventStrayRequests();
        }

        $this->app->bind(BestSellersHistoryApiClientInterface::class, function () {
            return new BestSellersHistoryApiClient()->setNyTimesHttpClient(Http::withQueryParameters([
                'api-key' => config('nytimes.api_key'),
            ])->baseUrl('https://api.nytimes.com/'));
        });
    }
}
