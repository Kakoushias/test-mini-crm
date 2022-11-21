<?php


namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionWriteRepository
{
    public function store(float $amount, int $clientId, Carbon $transactionDate): void
    {
        $transaction                   = new Transaction();
        $transaction->amount           = $amount;
        $transaction->client_id        = $clientId;
        $transaction->transaction_date = $transactionDate;
        $transaction->save();
    }

    public function update(Transaction $transaction, float $amount, int $clientId, Carbon $transactionDate): void
    {
        $transaction->amount           = $amount;
        $transaction->transaction_date = $transactionDate;
        $transaction->client_id        = $clientId;
        $transaction->save();
    }
}
