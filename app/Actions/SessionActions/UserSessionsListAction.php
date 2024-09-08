<?php

namespace App\Actions\SessionActions;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Response;
use Laravel\Passport\Token;

class UserSessionsListAction
{
    public static function execute(int $userId): array
    {
        $tokens = Token::query()->where('user_id', $userId)
            ->where('revoked', false)
            ->get();

        return ResponseHelper::makeResponseArray(
            Response::HTTP_OK,
            $tokens->map(function ($token) {
                return [
                    'id' => $token->id,
                    'client_id' => $token->client_id,
                    'name' => $token->name,
                    'scopes' => $token->scopes,
                    'created_at' => $token->created_at,
                    'expires_at' => $token->expires_at,
                ];
            })->toArray(),
        );
    }
}
