<?php

use App\Domain\NyTimes\Rules\IsbnRule;

test('it should throw an InvalidArgumentException if isbn is invalid', function ($isbn, $message) {
    $isbnRule = new IsbnRule();

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage($message);
    $isbnRule->validate($isbn);
})->with([
    ['123456789', 'isbn must be a valid ISBN.'],
    ['12345678901234', 'isbn must be a valid ISBN.'],
    ['123456789;12345678901234', 'isbn must be a valid ISBN.'],
    ['1111111111;', 'isbn must not end with a semicolon.'],
]);

test('it should return true if isbn is valid', function ($isbn) {
    $isbnRule = new IsbnRule();

    expect($isbnRule->validate($isbn))->toBeTrue();
})->with([
    ['1234567890'],
    ['1234567890123'],
    ['1234567890;1234567890123'],
    ['1111111111'],
    ['1111111111111'],
]);
