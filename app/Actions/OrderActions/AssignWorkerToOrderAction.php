<?php

namespace App\Actions\OrderActions;

use App\DTOs\OrderDTOs\AssignWorkerToOrderDTO;
use App\Helpers\ResponseHelper;
use App\Models\Order;
use App\Models\Worker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssignWorkerToOrderAction
{
    public function execute(AssignWorkerToOrderDTO $dto): array
    {
        $order = Order::query()->where('id', $dto->orderId)->first();

        $worker = Worker::query()->where('id', $dto->workerId)->first();
        $excludedOrderTypes = $worker->excludedOrderTypes()->pluck('order_type_id');

        if ($excludedOrderTypes->contains($order->type_id)) {
            return  ResponseHelper::makeResponseArray(
                ResponseAlias::HTTP_FORBIDDEN,
                [],
                'Исполнитель отказался от заказов такого типа');
        }

        $order->orderWorker()->attach($worker->id, ['amount' => $order->amount]);
        $order->status = 'assigned';

        $order->save();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, $order->toArray());
    }
}
