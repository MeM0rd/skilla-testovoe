<?php

namespace App\Actions\AuthActions;

use App\DTOs\AuthDTOs\RegisterDTO;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Contracts\Hashing\Hasher;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterAction
{
    protected Hasher $hasher;

    public function __construct(Hasher $hasher){
        $this->hasher = $hasher;
    }
    public function execute(RegisterDTO $dto): array
    {
        $user = User::query()->where('email', $dto->email)->first();

        if (!empty($user)) {
            return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_FORBIDDEN, [], 'User already exists.');
        }

        $user = new User;

        $user->email = $dto->email;
        $user->name = $dto->name;
        $user->password = $this->hasher->make($dto->password);

        $user->save();

        $oClient = $this->createPassportClient($user);

        return ResponseHelper::makeResponseArray(ResponseAlias::HTTP_OK, $oClient->toArray());
    }

    protected function createPassportClient(User $user): Client
    {
        $client = new Client();
        $client->user_id = $user->id;
        $client->name = $user->email . "'s Personal Client";
        $client->redirect = env('APP_URL');
        $client->personal_access_client = false;
        $client->password_client = true;
        $client->revoked = false;
        $client->save();

        return $client;
    }
}
