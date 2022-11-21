<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = Client::get();

        if ($clients->isEmpty()) {
            $clients = Client::factory()->count(100)->create();
        }

        foreach ($clients as $client) {
            Transaction::factory()
                       ->count(20)
                       ->for($client)
                       ->create();
        }
    }
}
