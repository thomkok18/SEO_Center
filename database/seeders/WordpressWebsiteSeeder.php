<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordpressWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wordpress_websites')->insert([
            'status_id' => 1,
            'url' => 'https://testwebsite1.nl/wp-json/wp/v2',
            'username' => 'testuser1234',
            'token' => 'qE3m 9wcU L9M1 2TV3 xeuS jTAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_websites')->insert([
            'status_id' => 1,
            'url' => 'https://testwebsite2.nl/wp-json/wp/v2',
            'username' => 'testuser1234',
            'token' => 'qE3m 9wcU L9M1 2TV3 xeuS jTAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_websites')->insert([
            'status_id' => 1,
            'url' => 'https://testwebsite3.nl/wp-json/wp/v2',
            'username' => 'testuser1234',
            'token' => 'qE3m 9wcU L9M1 2TV3 xeuS jTAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
