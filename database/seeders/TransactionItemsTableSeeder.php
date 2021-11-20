<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TransactionItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_items')->insert([
            'id' => 1,
            'name' => '食材費',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 2,
            'name' => '外食費',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 3,
            'name' => '個別A',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 4,
            'name' => '個別B',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 5,
            'name' => '日用品',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 6,
            'name' => '交際費',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 7,
            'name' => '養育費',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 8,
            'name' => '贅沢費',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 9,
            'name' => '特別費',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 10,
            'name' => '雑益',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 11,
            'name' => '雑損',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 12,
            'name' => '立替A',
        ]);
        DB::table('transaction_items')->insert([
            'id' => 13,
            'name' => '立替B',
        ]);
    }
}
