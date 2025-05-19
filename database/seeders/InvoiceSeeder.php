<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            'customer_id' => 3,
            'supplier_id' => 1,
            'status_id' => 1,
            'date' => date('Y-m-d', strtotime("2021-06-01")),
            'price' => 120.43,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
