<?php

namespace App\Actions\AuthActions;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LogoutAction
{
    public function execute(User $user): array
    {
        $user->token()->revoke();

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, []);
    }
}
