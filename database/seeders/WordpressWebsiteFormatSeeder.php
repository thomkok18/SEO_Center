<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordpressWebsiteFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wordpress_website_formats')->insert([
            'name' => 'standard',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_formats')->insert([
            'name' => 'gallery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_formats')->insert([
            'name' => 'image',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_formats')->insert([
            'name' => 'quote',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_formats')->insert([
            'name' => 'video',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_formats')->insert([
            'name' => 'audio',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('wordpress_website_formats')->insert([
            'name' => 'link',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
