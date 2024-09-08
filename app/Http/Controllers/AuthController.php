<?php

namespace App\Http\Controllers;

use App\Actions\AuthActions\LoginAction;
use App\Actions\AuthActions\LogoutAction;
use App\Actions\AuthActions\RegisterAction;
use App\Factories\AuthFactories\LoginFactory;
use App\Factories\AuthFactories\RegisterFactory;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        $dto = LoginFactory::makeDTO($request);

        $result = $action->execute($dto);

        return response()->json($result['data'])->setStatusCode($result['status'])->header('access-token', $result['data']['token']);
    }

    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $dto = RegisterFactory::makeDTO($request);

        $result = $action->execute($dto);

        return response()->json(['data' => $result['data'], 'message' => $result['message']])->setStatusCode($result['status']);
    }

    public function logout(Request $request, LogoutAction $action): JsonResponse
    {
        $result = $action->execute($request->user());

        return response()->json(['data' => $result['data'], 'message' => $result['message']])->setStatusCode($result['status']);
    }
}
