<?php

use App\Domain\NyTimes\Rules\OffsetRule;

test('it should throw an InvalidArgumentException if offset is invalid', function ($offset, $message) {
    $offsetRule = new OffsetRule();

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage($message);
    $offsetRule->validate($offset);
})->with([
    ['abc', 'offset must be numeric'],
    [10, 'offset must be a multiple of 20'],
]);

test('it should return true if offset is valid', function ($offset) {
    $offsetRule = new OffsetRule();

    expect($offsetRule->validate($offset))->toBeTrue();
})->with([
    [0],
    [20],
    [40],
]);
