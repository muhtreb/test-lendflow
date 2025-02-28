<?php

namespace App\Application\Http\Controllers\NyTimes\BestSellerHistory;

use App\Application\Http\Controllers\Controller;
use App\Application\Http\Requests\NyTimes\BestSellersHistory\GetRequest;
use App\Domain\NyTimes\Exception\BestSellersHistoryErrorApiException;
use App\Domain\NyTimes\Exception\BestSellersHistoryUnauthenticatedApiException;
use App\Domain\NyTimes\UseCases\GetBestSellersHistoryUseCase;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __invoke(GetBestSellersHistoryUseCase $useCase, GetRequest $request): JsonResponse
    {
        try {
            return response()->json($useCase->execute($request->safe()->all()));
        } catch (BestSellersHistoryUnauthenticatedApiException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (BestSellersHistoryErrorApiException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch best sellers history'], 500);
        }
    }
}
