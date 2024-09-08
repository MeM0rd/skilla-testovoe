<?php

namespace App\Factories\AuthFactories;

use App\DTOs\AuthDTOs\LoginDTO;
use App\Http\Requests\AuthRequests\LoginRequest;

class LoginFactory
{
    public static function makeDTO(LoginRequest $request): LoginDTO
    {
        $dto = new LoginDTO();

        $dto->email = $request->get('email');
        $dto->password = $request->get('password');

        return $dto;
    }
}
