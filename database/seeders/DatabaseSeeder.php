<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
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

        Client::factory()->count(100)->create();
    }
}
