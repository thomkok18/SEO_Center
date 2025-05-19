<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'enabled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statuses')->insert([
            'name' => 'disabled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
