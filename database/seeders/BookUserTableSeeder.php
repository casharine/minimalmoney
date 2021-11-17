<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('book_user')->insert([
        'book_id' => 1,
        'user_id' => 1
    ]);

    DB::table('book_user')->insert([
        'book_id' => 2,
        'user_id' => 1
    ]);

    
    DB::table('book_user')->insert([
        'book_id' => 3,
        'user_id' => 2
    ]);
    
    DB::table('book_user')->insert([
        'book_id' => 4,
        'user_id' => 3
    ]);
    }
}
