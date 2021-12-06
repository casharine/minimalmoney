<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanningsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 5,
            'price' => 20000,
            'date' => 20211116,
        ]);
    }
}
