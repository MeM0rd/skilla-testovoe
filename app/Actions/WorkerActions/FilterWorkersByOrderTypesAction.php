<?php

namespace App\Actions\WorkerActions;

use App\Helpers\ResponseHelper;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FilterWorkersByOrderTypesAction
{
    public function execute(array $orderTypes): array
    {
        $workers = Worker::query()->whereHas('excludedOrderTypes', function (Builder $query) use ($orderTypes) {
            $query->whereNotIn('order_type_id', $orderTypes);
        })->get()->toArray();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, $workers);
    }
}
