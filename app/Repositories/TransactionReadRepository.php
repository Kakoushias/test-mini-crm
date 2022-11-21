<?php


namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionReadRepository
{
    public function paginate($pageSize = 10) : LengthAwarePaginator
    {
        return Transaction::with('client')
        ->paginate(10);
    }
}
