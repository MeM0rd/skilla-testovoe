<?php

namespace App\Factories\OrderFactories;

use App\DTOs\OrderDTOs\UpdateOrderStatusDTO;
use App\Http\Requests\OrderRequests\UpdateOrderStatusRequest;

class UpdateOrderStatusFactory
{
    public static function makeDTO(UpdateOrderStatusRequest $request): UpdateOrderStatusDTO
    {
        $dto = new UpdateOrderStatusDTO();

        $dto->orderId = $request->get('order_id');
        $dto->status = $request->get('status');

        return $dto;
    }
}
