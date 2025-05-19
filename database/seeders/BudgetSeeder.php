<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2025-02-01")),
            'amount' => 1400,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2025-01-01")),
            'amount' => 1600,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-06-01")),
            'amount' => 2200,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-05-01")),
            'amount' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 3,
            'date' => date('Y-m-d', strtotime("2021-05-01")),
            'amount' => 800,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-04-01")),
            'amount' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 2,
            'date' => date('Y-m-d', strtotime("2021-04-01")),
            'amount' => 2500,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 3,
            'date' => date('Y-m-d', strtotime("2021-04-01")),
            'amount' => 600,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-03-01")),
            'amount' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 2,
            'date' => date('Y-m-d', strtotime("2021-03-01")),
            'amount' => 1800,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 3,
            'date' => date('Y-m-d', strtotime("2021-03-01")),
            'amount' => 600,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-02-01")),
            'amount' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 2,
            'date' => date('Y-m-d', strtotime("2021-02-01")),
            'amount' => 1800,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-01-01")),
            'amount' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('budgets')->insert([
            'website_id' => 2,
            'date' => date('Y-m-d', strtotime("2021-01-01")),
            'amount' => 1800,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
