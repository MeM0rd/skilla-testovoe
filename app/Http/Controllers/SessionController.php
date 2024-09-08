<?php

namespace App\Http\Controllers;

use App\Actions\SessionActions\DeleteUserSessionAction;
use App\Actions\SessionActions\UserSessionsListAction;
use App\Http\Requests\SessionRequests\RevokeUserSessionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getUserSessions(int $userId, UserSessionsListAction $action): JsonResponse
    {
        $result = $action->execute($userId);

        return response()->json($result['data'])->setStatusCode($result['status']);
    }

    public function revokeUserSession(RevokeUserSessionRequest $request, DeleteUserSessionAction $action): JsonResponse
    {
        $result = $action->execute($request->get('token_id'));

        return response()->json($result['data'])->setStatusCode($result['status']);
    }
}
