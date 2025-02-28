<?php

use Illuminate\Support\Facades\Http;

test('it should return 401 if api key is not invalid', function () {
    config(['nytimes.api_key' => 'invalid-api-key']);

    Http::fake([
        'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=invalid-api-key' => Http::response([
            'error' => 'Unauthorized',
        ], 401)
    ]);

    $response = $this->get('/api/nytimes/best-sellers-history');
    $response->assertStatus(401);
    $response->assertJson([
        'error' => 'Failed to authenticate with the best sellers history API',
    ]);
});

test('it should return 200 and same response from api', function () {
    $fakeReturn = [
        'status' => 'OK',
        'num_results' => 0,
        'results' => [],
    ];

    config(['nytimes.api_key' => 'fake-api-key']);

    Http::fake([
        'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=fake-api-key' => Http::response($fakeReturn, 200),
    ]);

    $response = $this->get('/api/nytimes/best-sellers-history');
    $response->assertStatus(200);
    $response->assertJson($fakeReturn);
});

test('offset not multiple of 20 should return 400', function () {
    $response = $this->get('/api/nytimes/best-sellers-history?offset=21', [
        'Accept' => 'application/json',
    ]);
    $response->assertStatus(422);
    $response->assertJson([
        'message' => 'offset must be a multiple of 20.',
        'errors' => [
            'offset' => ['offset must be a multiple of 20.'],
        ],
    ]);
});

test('isbn not valid should return 422', function () {
    $response = $this->get('/api/nytimes/best-sellers-history?isbn=12345678901234567', [
        'Accept' => 'application/json',
    ]);
    $response->assertStatus(422);
    $response->assertJson([
        'message' => 'isbn must be a valid ISBN.',
        'errors' => [
            'isbn' => ['isbn must be a valid ISBN.'],
        ],
    ]);
});

test('it should return 400 when api return 400', function () {
    $fakeReturn = [
        'status' => 'ERROR',
        'errors' => [
            'title' => 'Not a valid title',
        ],
    ];

    config(['nytimes.api_key' => 'fake-api-key']);

    Http::fake([
        'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=fake-api-key' => Http::response($fakeReturn, 400),
    ]);

    $response = $this->get('/api/nytimes/best-sellers-history');
    $response->assertStatus(400);
    $response->assertJson([
        'error' => 'Failed to fetch best sellers history'
    ]);
});
