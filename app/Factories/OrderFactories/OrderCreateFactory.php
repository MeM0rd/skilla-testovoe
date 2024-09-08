<?php

namespace App\Factories\OrderFactories;

use App\DTOs\OrderDTOs\OrderCreateDTO;
use App\Http\Requests\OrderRequests\OrderCreateRequest;
use Carbon\Carbon;

class OrderCreateFactory
{
    public static function makeDTO(OrderCreateRequest $request): OrderCreateDTO
    {
        $dto = new OrderCreateDTO();

        $dto->userId = $request->user()->id;
        $dto->typeId = $request->get('type_id');
        $dto->partnershipId = $request->get('partnership_id');
        $dto->description = $request->get('description');
        $dto->date = Carbon::parse($request->get('date'));
        $dto->address = $request->get('address');
        $dto->amount = $request->get('amount');
        $dto->status = $request->get('status');

        return $dto;
    }
}
