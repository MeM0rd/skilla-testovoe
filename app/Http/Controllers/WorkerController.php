<?php

namespace App\Http\Controllers;

use App\Actions\WorkerActions\FilterWorkersByOrderTypesAction;
use App\Http\Requests\WorkerRequests\FilterWorkersByOrderTypesRequest;

class WorkerController extends Controller
{
    public function filterByOrderTypes(FilterWorkersByOrderTypesRequest $request, FilterWorkersByOrderTypesAction $action)
    {
        $result = $action->execute($request->validated()['order_types']);

        return response()->json($result['data'])->setStatusCode($result['status']);
    }
}
