<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanningItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planning_items')->insert([
            'id' => 1,
            'name' => '食材費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 2,
            'name' => '外食費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 3,
            'name' => '個別A',
        ]);
        DB::table('planning_items')->insert([
            'id' => 4,
            'name' => '個別B',
        ]);
        DB::table('planning_items')->insert([
            'id' => 5,
            'name' => '日用品',
        ]);
        DB::table('planning_items')->insert([
            'id' => 6,
            'name' => '交際費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 7,
            'name' => '養育費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 8,
            'name' => '贅沢費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 9,
            'name' => '特別費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 10,
            'name' => '家賃',
        ]);
        DB::table('planning_items')->insert([
            'id' => 11,
            'name' => '他固定費',
        ]);
        DB::table('planning_items')->insert([
            'id' => 12,
            'name' => '小遣いA',
        ]);
        DB::table('planning_items')->insert([
            'id' => 13,
            'name' => '小遣いB',
        ]);
        DB::table('planning_items')->insert([
            'id' => 14,
            'name' => '普通預金',
        ]);
        DB::table('planning_items')->insert([
            'id' => 15,
            'name' => '中期預金',
        ]);
        DB::table('planning_items')->insert([
            'id' => 16,
            'name' => '長期預金',
        ]);
        DB::table('planning_items')->insert([
            'id' => 17,
            'name' => '養育預金',
        ]);
        DB::table('planning_items')->insert([
            'id' => 18,
            'name' => '国債',
        ]);
        DB::table('planning_items')->insert([
            'id' => 19,
            'name' => '株',
        ]);
        DB::table('planning_items')->insert([
            'id' => 20,
            'name' => '予算合計',
        ]);
    }
}
