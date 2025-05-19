<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'English',
            'code' => 'en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('languages')->insert([
            'name' => 'Nederlands',
            'code' => 'nl',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
