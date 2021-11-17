<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'name' => 'A',
            'active_flag' => 't',
            'authorizer_id' => 1,
        ]);
        DB::table('books')->insert([
            'name' => 'B',
            'active_flag' => 'f',
            'authorizer_id' => 1
        ]);
        DB::table('books')->insert([
            'name' => 'C',
            'active_flag' => 'f',
            'authorizer_id' => 2,
        ]);
                DB::table('books')->insert([
            'name' => 'D',
            'active_flag' => 'f',
            'authorizer_id' => 3,
        ]);
    }
}
