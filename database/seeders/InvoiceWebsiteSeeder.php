<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_websites')->insert([
            'invoice_id' => 1,
            'website_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('invoice_websites')->insert([
            'invoice_id' => 1,
            'website_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
