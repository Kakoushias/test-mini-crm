<?php


namespace App\Repositories;

use App\Models\Client;

class ClientWriteRepository
{
    public function store(string $firstName, string $lastName, string $filePath, string $email): void
    {
        $client             = new Client();
        $client->first_name = $firstName;
        $client->last_name  = $lastName;
        $client->avatar     = $filePath;
        $client->email      = $email;
        $client->save();
    }

    public function update(Client $client, string $firstName, string $lastName, string $filePath, string $email){
        $client->first_name = $firstName;
        $client->last_name  = $lastName;
        $client->email      = $email;
        $client->avatar = $filePath;
        $client->save();
    }
}
