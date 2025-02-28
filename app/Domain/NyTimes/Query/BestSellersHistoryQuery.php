<?php

namespace App\Domain\NyTimes\Query;

class BestSellersHistoryQuery
{
    public function __construct(
        public ?string $author = null,
        public ?string $title = null,
        public ?string $isbn = null,
        public ?int $offset = null
    )
    {
    }
}