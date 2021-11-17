<?php

namespace Database\Seeders;

use App\Enums\Transaction;
use App\Enums\TransactionItemType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'editor_id' => 1,
            'price' => 100,
            'item' => '日用費',
            'date' => 20211117,
            'note' => '水',
            'book_id' => 1,
        ]);
    }
}
