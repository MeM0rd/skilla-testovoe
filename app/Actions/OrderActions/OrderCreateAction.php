<?php

namespace App\Actions\OrderActions;

use App\DTOs\OrderDTOs\OrderCreateDTO;
use App\Helpers\ResponseHelper;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderCreateAction
{
    public function execute(OrderCreateDTO $dto): array
    {
        $order = new Order();

        $order->user_id = $dto->userId;
        $order->type_id = $dto->typeId;
        $order->partnership_id = $dto->partnershipId;
        $order->description = $dto->description;
        $order->date = $dto->date;
        $order->address = $dto->address;
        $order->amount = $dto->amount;
        $order->status = $dto->status;

        $order->save();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, $order->toArray());
    }
}
