<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionUrlCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 1,
            'check_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 1,
            'check_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 1,
            'check_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 2,
            'check_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 4,
            'check_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 5,
            'check_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 6,
            'check_id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 7,
            'check_id' => 8,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_url_checks')->insert([
            'promotion_url_id' => 8,
            'check_id' => 9,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
