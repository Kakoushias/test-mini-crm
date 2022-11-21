<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use function PHPUnit\Framework\assertEquals;

test('controller fetches paginated data', function () {

    //seed transaction and authenticate administrator
    Transaction::factory()->count(100)->create();
    auth()->login(
        User::factory()->create()
    );

    //get first page, assert see only 10 clients returned
    /**
     * @var Illuminate\Testing\TestResponse $response
     * */
    $response = $this->get(route('transactions.index'));

    $transactions = collect($response->getOriginalContent()->getData()['transactions']->items());
    assertEquals($transactions->count(), 10);


    //get second page, assert see only 10 clients returned, assert none are the same as previous page
    /**
     * @var Illuminate\Testing\TestResponse $response
     * */
    $response = $this->get(route('transactions.index', ['page' => 2]));

    $secondBatchTransactions = collect($response->getOriginalContent()->getData()['transactions']->items());
    assertEquals($secondBatchTransactions->count(), 10);
    assertEquals(
        $transactions->intersect($secondBatchTransactions)->count(),
        0
    );

});
