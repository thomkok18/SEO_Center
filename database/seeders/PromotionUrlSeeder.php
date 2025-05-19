<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 1,
            'url_type_id' => 1,
            'conclusion_id' => 2,
            'website_id' => 1,
            'price_type_id' => null,
            'promotion_url' => 'https://www.test.com/testapparaten',
            'custom_price' => 56.40,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 1,
            'url_type_id' => 2,
            'conclusion_id' => 2,
            'website_id' => 1,
            'price_type_id' => null,
            'promotion_url' => 'https://www.hallowereld.com/wereld',
            'custom_price' => 72.10,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 1,
            'url_type_id' => 1,
            'conclusion_id' => 1,
            'website_id' => 2,
            'price_type_id' => 1,
            'promotion_url' => 'https://www.testing.com/testers',
            'custom_price' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 2,
            'url_type_id' => 1,
            'conclusion_id' => 6,
            'website_id' => 2,
            'price_type_id' => 2,
            'promotion_url' => 'https://www.bloggewoon.com/mijnblog',
            'custom_price' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 2,
            'url_type_id' => 2,
            'conclusion_id' => 6,
            'website_id' => 2,
            'price_type_id' => null,
            'promotion_url' => 'https://www.mybacklink.com/link',
            'custom_price' => 39.45,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 2,
            'url_type_id' => 2,
            'conclusion_id' => 2,
            'website_id' => 2,
            'price_type_id' => 1,
            'promotion_url' => 'https://www.mybonusbacklink.com/link',
            'custom_price' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 3,
            'supplier_id' => 2,
            'url_type_id' => 2,
            'conclusion_id' => 2,
            'website_id' => 2,
            'price_type_id' => 2,
            'promotion_url' => 'https://www.smartbacklink.com/link',
            'custom_price' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('promotion_urls')->insert([
            'customer_id' => 4,
            'supplier_id' => 2,
            'url_type_id' => 1,
            'conclusion_id' => 6,
            'website_id' => 3,
            'price_type_id' => 3,
            'promotion_url' => 'https://www.bloggewoon.com/andereblog',
            'custom_price' => null,
            'archived' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
