<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MozCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moz_checks')->insert([
            'domain_authority' => 50,
            'domain_name' => 'test.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 60,
            'domain_name' => 'test.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 90,
            'domain_name' => 'test.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 37,
            'domain_name' => 'hallowereld.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 30,
            'domain_name' => 'bloggewoon.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 32,
            'domain_name' => 'mybacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 7,
            'domain_name' => 'mybonusbacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 7,
            'domain_name' => 'smartbacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('moz_checks')->insert([
            'domain_authority' => 7,
            'domain_name' => 'smartbacklink.com',
            'indexed_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
        ]);
    }
}
