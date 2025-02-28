<?php

namespace App\Domain\NyTimes\ApiClient;

use Illuminate\Http\Client\PendingRequest;

trait UseNyTimesHttpClientTrait
{
    protected PendingRequest $client;

    public function setNyTimesHttpClient(PendingRequest $client): self
    {
        $this->client = $client;

        return $this;
    }
}
