<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => Role::ADMIN,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Thom',
            'inserts' => '',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 't.kok@gmu.online',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::ADMIN,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Martijn',
            'inserts' => '',
            'lastname' => 'Wieringa',
            'phone' => '',
            'email' => 'm.wieringa@gmu.online',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::SUPPLIER,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Thom',
            'inserts' => 'van der',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'supplier@gmu.online',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::SUPPLIER,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 2,
            'firstname' => 'Thom',
            'inserts' => 'van der',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'supplier@dng.nl',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::SEO,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Thom',
            'inserts' => 'de',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'seo@gmu.online',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::SEO,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Tim',
            'inserts' => '',
            'lastname' => 'Oldenhuis',
            'phone' => '',
            'email' => 't.oldenhuis@gmu.online',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::SEO,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Wahak',
            'inserts' => '',
            'lastname' => 'Stepanian',
            'phone' => '',
            'email' => 'w.stepanian@gmu.online',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::CUSTOMER,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 3,
            'firstname' => 'Thom',
            'inserts' => '',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'customer@gewoon-gezond.nl',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::CUSTOMER,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 3,
            'firstname' => 'Thom',
            'inserts' => '',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'customer2@gewoon-gezond.nl',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::CUSTOMER,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 3,
            'firstname' => 'Thom',
            'inserts' => '',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'customer3@gewoon-gezond.nl',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => Role::CUSTOMER,
            'language_id' => 2,
            'status_id' => 1,
            'company_id' => 4,
            'firstname' => 'Thom',
            'inserts' => '',
            'lastname' => 'Kok',
            'phone' => '06-12345678',
            'email' => 'customer@weids-wonen.nl',
            'password' => Hash::make('testen24'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
