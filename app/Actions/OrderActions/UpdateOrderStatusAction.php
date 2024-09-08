<?php

namespace App\Actions\OrderActions;

use App\DTOs\OrderDTOs\UpdateOrderStatusDTO;
use App\Events\UpdateOrderStatusEvent;
use App\Helpers\ResponseHelper;
use App\Models\Order;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UpdateOrderStatusAction
{
    public static function execute(UpdateOrderStatusDTO $dto): array
    {
        $order = Order::query()->where('id', $dto->orderId)->first();
        $order->status = $dto->status;

        $order->save();

        broadcast(new UpdateOrderStatusEvent($order))->toOthers();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, $order->toArray());
    }
}
