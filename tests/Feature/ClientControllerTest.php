<?php

use App\Models\User;
use App\Models\Client;
use function PHPUnit\Framework\assertEquals;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('controller fetches paginated data', function () {

    //seed clients and authenticate user
    Client::factory()->count(100)->create();
    auth()->login(
        User::factory()->create()
    );

    //get first page, assert only 10 clients returned
    $response = $this->get(route('client-data', ['pageNumber' => 1]));

    $firstBatchIds = collect(
        $clients = $response->getData()
            ->clients
    )->pluck('id');

    $numberOfClientsFetched = count($clients);

    assertEquals($numberOfClientsFetched, 10);

    //get second page, assert only 10 clients returned, and that they are different from the first page
    $response = $this->get(route('client-data', ['pageNumber' => 2]));

    $secondBatchIds = collect(
        $clients = $response->getData()
            ->clients
    )->pluck('id');

    $numberOfClientsFetched = count($clients);

    assertEquals($numberOfClientsFetched, 10);

    assertEquals(
        $firstBatchIds->intersect($secondBatchIds)->count(),
        0
    );
});


test('controller stores new client', function () {

    //authenticate user
    auth()->login(
        User::factory()->create()
    );

    //create fake file
    $file = UploadedFile::fake()->image('avatar.jpg', 250, 250);

    //call api to store client, assert client correctly created
    $response = $this->post(route('clients.store'), [
        'first_name' => $firstName = fake()->firstName,
        'last_name'  => $lastName = fake()->lastName,
        'avatar'     => $file,
        'email'      => $email = fake()->email(),
    ]);

    $client = Client::where('first_name', $firstName)
                    ->where('last_name', $lastName)
                    ->first();

    assertEquals($client->first_name, $firstName);
    assertEquals($client->last_name, $lastName);
    assertEquals($client->avatar, 'public/' . $file->hashName());
    assertEquals($client->email, $email);
});

test('controller store validation fails when it should', function () {
    //authenticate user
    auth()->login(
        User::factory()->create()
    );

    //create fake file, smaller dimensions than required
    $file = UploadedFile::fake()->image('avatar2.jpg', 50, 50);

    //call api to store client, assert validation fail
    $response = $this->postJson(route('clients.store'), [
        'first_name' => fake()->firstName,
        'last_name'  => fake()->lastName,
        'avatar'     => $file,
        'email'      => fake()->email,
    ]);

    assertEquals($response->status(), 422);

    //repeat the test with file with valid dimensions but wrong email format
    $file = UploadedFile::fake()->image('avatar2.jpg', 150, 150);

    //call api to store client, assert validation fail
    $response = $this->postJson(route('clients.store'), [
        'first_name' => fake()->firstName,
        'last_name'  => fake()->lastName,
        'avatar'     => $file,
        'email'      => fake()->name,
    ]);

    assertEquals($response->status(), 422);
});


