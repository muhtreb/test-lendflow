<?php

use App\Application\Http\Controllers\NyTimes\BestSellerHistory\IndexController as NyTimesBestSellerHistoryIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/best-sellers-history', NyTimesBestSellerHistoryIndexController::class);