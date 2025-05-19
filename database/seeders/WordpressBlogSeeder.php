<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordpressBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wordpress_blogs')->insert([
            'wordpress_website_id' => null,
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'wordpress_website_blog_id' => 1,
            'title' => 'Test: wanneer en hoe gebruik je het?',
            'seo_title' => 'Test: wanneer en hoe gebruik je het?',
            'description' => 'Dit is een description',
            'image' => 'http://192.168.56.1:8000/test_image.jpg',
            'content' => 'dit is content',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
