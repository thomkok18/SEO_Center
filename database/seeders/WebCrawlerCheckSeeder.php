<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebCrawlerCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://wwww.test.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 4,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://wwww.test.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-04")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://wwww.test.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://www.hallowereld.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-03")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://www.bloggewoon.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://www.mybacklink.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://www.mybonusbacklink.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://www.smartbacklink.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-08")),
        ]);

        DB::table('web_crawler_checks')->insert([
            'domain_name' => 'https://www.smartbacklink.com',
            'server_ip' => '127.0.0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'follow_internal_links' => 2,
            'no_follow_internal_links' => 0,
            'follow_external_links' => 21,
            'no_follow_external_links' => 0,
            'follow_social_links' => 12,
            'no_follow_social_links' => 0,
            'follow_customer_links' => 25,
            'no_follow_customer_links' => 4,
            'follow_competitor_links' => 2,
            'no_follow_competitor_links' => 6,
            'image_count' => 2,
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-09")),
        ]);
    }
}
