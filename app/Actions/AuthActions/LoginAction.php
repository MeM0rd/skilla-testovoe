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

//        $http = new \GuzzleHttp\Client;
//
//        // Получение токена с помощью Password Grant
//        $response = $http->post(env('APP_URL') . '/oauth/token', [
//            'form_params' => [
//                'grant_type' => 'password',
//                'client_id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
//                'client_secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
//                'username' => $dto->email,
//                'password' => $dto->password,
//                'scope' => '',
//            ],
//        ]);

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK,
            [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
//                'data' => json_decode((string) $response->getBody(), true)
                'token' => $user->createToken('Api Token')->accessToken,
            ]);
    }
}
