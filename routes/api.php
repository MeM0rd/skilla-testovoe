<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::prefix('sessions')->group(function () {
        Route::get('/{user_id}', [SessionController::class, 'getUserSessions']);
        Route::post('/', [SessionController::class, 'revokeUserSession']);
    });

    Route::prefix('order')->group(function () {
        Route::post('/', [OrderController::class, 'create']);
        Route::post('/assign-worker', [OrderController::class, 'assignWorker']);
        Route::post('/update-status', [OrderController::class, 'updateStatus']);
    });

    Route::prefix('worker')->group(function () {
        Route::post('/filter-type', [WorkerController::class, 'filterByOrderTypes']);
    });
});

Route::group(['prefix' => '/passport'], function () {
    Route::post('/token', [AccessTokenController::class, 'issueToken']);

    $guard = config('passport.guard', null);
    Route::middleware(['web', $guard ? 'auth:'.$guard : 'auth'])->group(function () {
        Route::post('/token/refresh', [TransientTokenController::class, 'refresh']);
        Route::get('/tokens', [AuthorizedAccessTokenController::class, 'forUser']);
        Route::delete('/tokens/{token_id}', [AuthorizedAccessTokenController::class, 'destroy']);

        Route::prefix('/clients')->group(function () {
            Route::get('/', [ClientController::class, 'forUser']);
            Route::post('/', [ClientController::class, 'store']);
            Route::put('/{client_id}', [ClientController::class, 'update']);
            Route::delete('/{client_id}', [ClientController::class, 'destroy']);
        });

        Route::get('/scopes', [ScopeController::class, 'all']);

        Route::prefix('/personal-access-tokens')->group(function () {
            Route::get('/', [PersonalAccessTokenController::class, 'forUser']);
            Route::post('/', [PersonalAccessTokenController::class, 'store']);
            Route::delete('/{client_id}', [PersonalAccessTokenController::class, 'destroy']);
        });

    });
});

