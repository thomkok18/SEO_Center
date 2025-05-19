<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_statuses')->insert([
            'name' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('invoice_statuses')->insert([
            'name' => 'paid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('invoice_statuses')->insert([
            'name' => 'canceled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('invoice_statuses')->insert([
            'name' => 'delayed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
