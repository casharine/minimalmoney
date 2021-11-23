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
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 5,
            'price' => 100,
            'date' => 20211116,
            'note' => '水',
        ]);
    }
}
