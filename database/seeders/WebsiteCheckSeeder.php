<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 22,
            'citation_flow' => 37,
            'trust_flow' => 21,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 28,
            'citation_flow' => 44,
            'trust_flow' => 25,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-02-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-02-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-02-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 33,
            'citation_flow' => 47,
            'trust_flow' => 31,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 35,
            'citation_flow' => 56,
            'trust_flow' => 45,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 54,
            'citation_flow' => 67,
            'trust_flow' => 51,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 1,
            'domain_authority' => 63,
            'citation_flow' => 74,
            'trust_flow' => 56,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-06-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-06-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-06-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 2,
            'domain_authority' => 12,
            'citation_flow' => 36,
            'trust_flow' => 44,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-01-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 2,
            'domain_authority' => 26,
            'citation_flow' => 44,
            'trust_flow' => 49,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-02-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-02-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-02-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 2,
            'domain_authority' => 40,
            'citation_flow' => 55,
            'trust_flow' => 66,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 2,
            'domain_authority' => 65,
            'citation_flow' => 62,
            'trust_flow' => 71,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 3,
            'domain_authority' => 42,
            'citation_flow' => 65,
            'trust_flow' => 21,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-03-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 3,
            'domain_authority' => 57,
            'citation_flow' => 74,
            'trust_flow' => 38,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-04-01")),
        ]);

        DB::table('website_checks')->insert([
            'website_id' => 3,
            'domain_authority' => 70,
            'citation_flow' => 82,
            'trust_flow' => 43,
            'datetime' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-01")),
        ]);
    }
}
