<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::updateOrCreate([
             'name' => 'administrator',
             'email' => 'administrator@test.com',
             'password' => bcrypt('password')
         ]);

         //replace with each seeder
        $clients = Client::factory()->count(100)->create();

        foreach ($clients as $client){
            Transaction::factory()
                       ->count(20)
                       ->for($client)
                       ->create();
        }
    }
}
