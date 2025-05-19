<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConclusionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conclusion_types')->insert([
            'name' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'temporary_accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'temporary_denied',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'temporary_expired',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'denied',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'in_quarantine',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'in_quarantine_domain',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'in_quarantine_ip',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'in_quarantine_author',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conclusion_types')->insert([
            'name' => 'check_again',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
