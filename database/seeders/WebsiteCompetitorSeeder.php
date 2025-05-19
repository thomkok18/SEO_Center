<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteCompetitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitor_websites')->insert([
            'customer_id' => 3,
            'url' => 'https://www.concurrentgewoongezond.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitor_websites')->insert([
            'customer_id' => 3,
            'url' => 'https://www.beteregewoongezond.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitor_websites')->insert([
            'customer_id' => 4,
            'url' => 'https://www.weidswonenconcurrent.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
