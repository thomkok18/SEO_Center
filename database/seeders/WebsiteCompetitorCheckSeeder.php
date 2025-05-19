<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteCompetitorCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website_competitor_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 70,
            'citation_flow' => 82,
            'trust_flow' => 43,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
        ]);

        DB::table('website_competitor_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 68,
            'citation_flow' => 74,
            'trust_flow' => 48,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-06-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-06-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-06-01")),
        ]);

        DB::table('website_competitor_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 65,
            'citation_flow' => 78,
            'trust_flow' => 51,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-07-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-07-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-07-01")),
        ]);

        DB::table('website_competitor_checks')->insert([
            'website_id' => 2,
            'domain_authority' => 41,
            'citation_flow' => 28,
            'trust_flow' => 37,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
        ]);

        DB::table('website_competitor_checks')->insert([
            'website_id' => 2,
            'domain_authority' => 41,
            'citation_flow' => 28,
            'trust_flow' => 37,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
        ]);
    }
}
