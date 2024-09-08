<?php

namespace App\Factories\AuthFactories;

use App\DTOs\AuthDTOs\RegisterDTO;
use App\Http\Requests\AuthRequests\RegisterRequest;

class RegisterFactory
{
    public static function makeDTO(RegisterRequest $request): RegisterDTO
    {
        $dto = new RegisterDTO();

        $dto->email = $request->get('email');
        $dto->password = $request->get('password');
        $dto->name = $request->get('name');

        return $dto;
    }
}
