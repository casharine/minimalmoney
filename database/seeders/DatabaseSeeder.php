<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(BookUserTableSeeder::class);
        $this->call(SharingsTableSeeder::class);
        $this->call(TransactionItemsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(planningItemsTableSeeder::class);
        $this->call(planningsTableSeeder::class);
    }
}
