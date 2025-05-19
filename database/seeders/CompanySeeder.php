<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'GMU',
            'debtor_number' => null,
            'account_manager_email' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('companies')->insert([
            'name' => 'Digital News Group',
            'debtor_number' => null,
            'account_manager_email' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('companies')->insert([
            'name' => 'Gewoon Gezond',
            'debtor_number' => null,
            'account_manager_email' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('companies')->insert([
            'name' => 'Weids Wonen',
            'debtor_number' => null,
            'account_manager_email' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
