<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajesticCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('majestic_checks')->insert([
            'citation_flow' => 20,
            'trust_flow' => 70,
            'domain_name' => 'test.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 55,
            'trust_flow' => 80,
            'domain_name' => 'test.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 60,
            'trust_flow' => 95,
            'domain_name' => 'test.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 44,
            'trust_flow' => 37,
            'domain_name' => 'hallowereld.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 20,
            'trust_flow' => 55,
            'domain_name' => 'bloggewoon.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 10,
            'trust_flow' => 12,
            'domain_name' => 'mybacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 21,
            'trust_flow' => 30,
            'domain_name' => 'mybonusbacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 21,
            'trust_flow' => 30,
            'domain_name' => 'smartbacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('majestic_checks')->insert([
            'citation_flow' => 21,
            'trust_flow' => 30,
            'domain_name' => 'smartbacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
        ]);
    }
}
