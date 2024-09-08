<?php

namespace App\Factories\OrderFactories;

use App\DTOs\OrderDTOs\AssignWorkerToOrderDTO;
use App\Http\Requests\OrderRequests\AssignWorkerToOrderRequest;

class AssignWorkerToOrderFactory
{
    public  static function makeDTO(AssignWorkerToOrderRequest $request): AssignWorkerToOrderDTO
    {
        $dto = new AssignWorkerToOrderDTO();

        $dto->orderId = $request->get('order_id');
        $dto->workerId = $request->get('worker_id');

        return $dto;
    }
}
