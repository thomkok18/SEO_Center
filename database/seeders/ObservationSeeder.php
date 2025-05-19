<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('observations')->insert([
            'name_en' => '404 notification',
            'name_nl' => '404 melding',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'DA too low',
            'name_nl' => 'DA te laag',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'No image on the page',
            'name_nl' => 'Geen afbeelding op de pagina',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'High spamscore',
            'name_nl' => 'Hoge spamscore',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'IP equal to',
            'name_nl' => 'IP eerder gebruikt',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Link to the wrong website',
            'name_nl' => 'Link naar de verkeerde website',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Link not found',
            'name_nl' => 'Link niet aanwezig',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Not a real company',
            'name_nl' => 'Niet een echt bedrijf',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Bad image on the page',
            'name_nl' => 'Slechte afbeelding op de pagina',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Not enough text on the website',
            'name_nl' => 'Te weinig tekst op de website',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'TF/CF too low',
            'name_nl' => 'TF/CF te laag',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Theme does not fit',
            'name_nl' => 'Thema sluit niet aan',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('observations')->insert([
            'name_en' => 'Website used before',
            'name_nl' => 'Website is eerder gebruikt',
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
