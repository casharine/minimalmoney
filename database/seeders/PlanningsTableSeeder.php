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
            'planning_item_id' => 1,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 2,
            'planning_item_id' => 2,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 3,
            'planning_item_id' => 3,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 4,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 5,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 6,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 7,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 8,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 9,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 10,
            'price' => 200000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 11,
            'price' => 20000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 12,
            'price' => 40000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 13,
            'price' => 40000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 14,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 15,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 16,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 17,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 18,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 19,
            'price' => 10000,
            'date' => 20220223,
        ]);
        DB::table('plannings')->insert([
            'book_id' => 1,
            'editor_id' => 1,
            'planning_item_id' => 20,
            'price' => 70000,
            'date' => 20220223,
        ]);
    }
}
