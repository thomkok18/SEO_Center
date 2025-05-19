<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObservationCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('observation_checks')->insert([
            'observation_id' => 1,
            'check_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observation_checks')->insert([
            'observation_id' => 3,
            'check_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
