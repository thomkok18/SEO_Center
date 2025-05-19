<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            'company_id' => 3,
            'url' => 'https://www.gewoongezond.com',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('websites')->insert([
            'company_id' => 3,
            'url' => 'https://www.gewoongezond.nl',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('websites')->insert([
            'company_id' => 4,
            'url' => 'https://www.weidswonen.com',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
