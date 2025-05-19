<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            LanguageSeeder::class,
            StatusSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            UrlTypeSeeder::class,
            PriceTypeSeeder::class,
            ConclusionTypeSeeder::class,
            WebsiteSeeder::class,
            BudgetSeeder::class,
            PromotionUrlSeeder::class,
            WebCrawlerCheckSeeder::class,
            MajesticCheckSeeder::class,
            MozCheckSeeder::class,
            CheckSeeder::class,
            ObservationSeeder::class,
            ObservationCheckSeeder::class,
            PromotionUrlCheckSeeder::class,
            InvoiceStatusSeeder::class,
            InvoiceSeeder::class,
            InvoiceWebsiteSeeder::class,
            WebsiteCheckSeeder::class,
            WebsiteCompetitorSeeder::class,
            WebsiteCompetitorCheckSeeder::class,
            WordpressWebsiteFormatSeeder::class,
            WordpressWebsiteStatusSeeder::class,
            WordpressWebsiteSeeder::class,
            WordpressBlogSeeder::class,
            LinkSeeder::class,
        ]);
    }
}
