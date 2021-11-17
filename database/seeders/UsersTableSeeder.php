<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('users')->insert([
            'name' => '夫',
            'email' => 'otto@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        DB::table('users')->insert([
            'name' => '妻',
            'email' => 'tsuma@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        DB::table('users')->insert([
            'name' => '子',
            'email' => 'ko@gmail.com',
            'password' => bcrypt('12341234')
                    ]);

    }
}
