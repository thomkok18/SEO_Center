<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 1,
            'majestic_check_id' => 1,
            'moz_check_id' => 1,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 2,
            'majestic_check_id' => 2,
            'moz_check_id' => 2,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 3,
            'majestic_check_id' => 3,
            'moz_check_id' => 3,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 4,
            'majestic_check_id' => 4,
            'moz_check_id' => 4,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 5,
            'majestic_check_id' => 5,
            'moz_check_id' => 5,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 6,
            'majestic_check_id' => 6,
            'moz_check_id' => 6,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 7,
            'majestic_check_id' => 7,
            'moz_check_id' => 7,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 8,
            'majestic_check_id' => 8,
            'moz_check_id' => 8,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('checks')->insert([
            'user_id' => 4,
            'web_crawler_check_id' => 9,
            'majestic_check_id' => 9,
            'moz_check_id' => 9,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'latest_scan' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'latest_scan_update' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
        ]);
    }
}
