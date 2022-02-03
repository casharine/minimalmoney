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
            'transaction_item_id' => 1,
            'price' => 1000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 2,
            'price' => 2000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 3,
            'price' => 3000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 4,
            'price' => 4000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 5,
            'price' => 5000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 6,
            'price' => 6000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 7,
            'price' => 7000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 8,
            'price' => 8000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 9,
            'price' => 9000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 10,
            'price' => 10000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 11,
            'price' => 20000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 12,
            'price' => 12000,
            'date' => 20220223,
            'note' => '',
        ]);
        DB::table('transactions')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'transaction_item_id' => 13,
            'price' => 13000,
            'date' => 20220223,
            'note' => '',
        ]);
    }
}
