<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Passport\Client;

class PassportClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalAccessClient = Client::query()->updateOrCreate(
            [
                'name' => 'Laravel Personal Access Client',
                'personal_access_client' => true,
            ],
            [
                'user_id' => null,
                'secret' => bcrypt('EAGzAMhKLGPm5Nx12KgUIBbQ2bMqDv'),
                'redirect' => env('APP_URL'),
                'password_client' => false,
                'revoked' => false,
            ]
        );

        DB::table('oauth_personal_access_clients')->updateOrInsert(
            ['client_id' => $personalAccessClient->id],
            ['created_at' => now(), 'updated_at' => now()]
        );

        Client::query()->updateOrCreate(
            [
                'name' => 'Laravel Password Grant Client',
                'password_client' => true,
            ],
            [
                'user_id' => null,
                'secret' => bcrypt('g42K4zbG4VK23ypS1JVgat2801wKgI'),
                'redirect' => env('APP_URL'),
                'personal_access_client' => false,
                'revoked' => false,
            ]
        );
    }
}
