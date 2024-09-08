<?php

namespace App\Actions\AuthActions;

use App\DTOs\AuthDTOs\LoginDTO;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginAction
{
    public function execute(LoginDTO $dto): array
    {
        $isSuccess = Auth::attempt(['email' => $dto->email, 'password' => $dto->password]);

        if (!$isSuccess) {
            return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_UNAUTHORIZED, []);
        }

        /** @var User $user */
        $user = Auth::user();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK,
            [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'token' => $user->createToken('Api Token')->accessToken,
            ]);
    }
}
