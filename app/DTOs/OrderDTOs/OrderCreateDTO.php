<?php

namespace App\DTOs\OrderDTOs;

use Carbon\Carbon;

class OrderCreateDTO
{
    public int $userId;
    public int $typeId;

    public int $partnershipId;

    public string|null $description;

    public Carbon $date;

    public string $address;

    public float $amount;

    public string $status;
}
