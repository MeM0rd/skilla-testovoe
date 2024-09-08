<?php

namespace App\Actions\SessionActions;

use App\Helpers\ResponseHelper;
use Laravel\Passport\Token;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeleteUserSessionAction
{
    public function execute(string $tokenId): array
    {
        $token = Token::query()->where('id', $tokenId)
            ->first();

        if (!$token) {
            return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_FORBIDDEN, [], "Token not found");
        }

        $token->revoke();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, []);
    }
}
