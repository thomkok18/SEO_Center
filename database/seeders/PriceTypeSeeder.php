<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_types')->insert([
            'name_en' => 'Small price',
            'name_nl' => 'Kleine prijs',
            'price' => 25.50,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('price_types')->insert([
            'name_en' => 'Standard price',
            'name_nl' => 'Standaard prijs',
            'price' => 60.50,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('price_types')->insert([
            'name_en' => 'Big price',
            'name_nl' => 'Grote prijs',
            'price' => 105.35,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
