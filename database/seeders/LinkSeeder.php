<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            'website' => 'https://koopjesblog.nl/koopjestips/',
            'anchor_text' => 'lalashop',
            'anchor_url' => 'https://www.lalashops.nl/',
            'created_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
            'updated_at' => date("Y-m-d H:i:s", strtotime("2021-05-02")),
        ]);
    }
}
