<?php

namespace App\Console\Schedule;

use App\Helpers\WebsiteScoreData;
use App\Models\CompetitorWebsite;
use Illuminate\Support\Facades\DB;

class IndexCustomerAndCompetitorWebsite
{
    /**
     * All customer websites and competitor websites are getting indexed at the 24th of each month.
     *
     * @return void
     */
    public function __invoke()
    {
        $customer_websites = DB::table('websites')->select('url')->get()->toArray();
        $competitor_websites = CompetitorWebsite::getCompetitorWebsitesWithoutArchivedCustomer();

        $website_list = [];

        foreach ($customer_websites as $customer_website) {
            $url = str_replace("www.","", parse_url($customer_website->url, PHP_URL_HOST));
            array_push($website_list, $url);
        }

        foreach ($competitor_websites as $competitor_website) {
            $url = str_replace("www.","", parse_url($competitor_website->url, PHP_URL_HOST));
            array_push($website_list, $url);
        }

        WebsiteScoreData::indexation($website_list);
    }
}
