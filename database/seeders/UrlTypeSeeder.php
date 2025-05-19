<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrlTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('url_types')->insert([
            'name' => 'blog',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('url_types')->insert([
            'name' => 'backlink',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
