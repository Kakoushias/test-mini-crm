<?php


namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientReadRepository
{
    public function count(): int
    {
        return Client::count();
    }

    public function get($limit = 10, $offset = 0): Collection
    {
        return Client::limit($limit)
                     ->offset($offset)
                     ->get();
    }
}
