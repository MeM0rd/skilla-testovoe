<?php

namespace App\Http\Controllers;

use App\Actions\OrderActions\AssignWorkerToOrderAction;
use App\Actions\OrderActions\OrderCreateAction;
use App\Factories\OrderFactories\AssignWorkerToOrderFactory;
use App\Factories\OrderFactories\OrderCreateFactory;
use App\Http\Requests\OrderRequests\AssignWorkerToOrderRequest;
use App\Http\Requests\OrderRequests\OrderCreateRequest;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function create(OrderCreateRequest $request, OrderCreateAction $action): JsonResponse
    {
        $dto = OrderCreateFactory::makeDTO($request);

        $result = $action->execute($dto);

        return response()->json($result['data'])->setStatusCode($result['status']);
    }

    public function assignWorker(AssignWorkerToOrderRequest $request, AssignWorkerToOrderAction $action): JsonResponse
    {
        $dto = AssignWorkerToOrderFactory::makeDTO($request);

        $result = $action->execute($dto);

        return response()->json($result['data'])->setStatusCode($result['status']);
    }
}
