<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordpressWebsiteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wordpress_website_statuses')->insert([
            'name' => 'draft',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_statuses')->insert([
            'name' => 'publish',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_statuses')->insert([
            'name' => 'future',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_statuses')->insert([
            'name' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_statuses')->insert([
            'name' => 'private',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
