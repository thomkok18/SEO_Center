<?php

namespace App\Console\Schedule;

use App\Helpers\WebsiteScoreData;
use App\Models\CompetitorWebsite;
use App\Models\Website;
use App\Models\WebsiteCheck;
use App\Models\WebsiteCompetitorCheck;
use Illuminate\Support\Facades\DB;

class GetIndexedCustomerAndCompetitorWebsiteScores
{
    /**
     * All customer website and competitor website scores are retrieved from yesterdays indexation and saved into the database.
     *
     * @return void
     */
    public function __invoke()
    {
        $customer_websites = DB::table('websites')->select('url')->get()->toArray();
        $competitor_websites = CompetitorWebsite::getCompetitorWebsitesWithoutArchivedCustomer();

        $customer_website_list = [];
        $competitor_website_list = [];

        foreach ($customer_websites as $customer_website) {
            $url = str_replace("www.","", parse_url($customer_website->url, PHP_URL_HOST));
            array_push($customer_website_list, $url);
        }

        foreach ($competitor_websites as $competitor_website) {
            $url = str_replace("www.","", parse_url($competitor_website->url, PHP_URL_HOST));
            array_push($competitor_website_list, $url);
        }

        for ($i = 0; $i < count($customer_website_list); $i++) {
            $urlData = WebsiteScoreData::domains([$customer_website_list[$i]]);

            if (count($urlData ) > 0) {
                WebsiteCheck::create([
                    'website_id' => Website::where('url', $customer_website_list[$i])->select('id')->get()->toArray()[0]['id'],
                    'domain_authority' => $urlData[$customer_website_list[$i]]['domain_authority'],
                    'citation_flow' => $urlData[$customer_website_list[$i]]['citation_flow'],
                    'trust_flow' => $urlData[$customer_website_list[$i]]['trust_flow'],
                    'datetime' => now(),
                ]);
            }
        }

        for ($i = 0; $i < count($competitor_website_list); $i++) {
            $urlData = WebsiteScoreData::domains([$competitor_website_list[$i]]);

            if (count($urlData ) > 0) {
                WebsiteCompetitorCheck::create([
                    'website_id' => CompetitorWebsite::where('url', $competitor_website_list[$i])->select('id')->get()->toArray()[0]['id'],
                    'domain_authority' => $urlData[$competitor_website_list[$i]]['domain_authority'],
                    'citation_flow' => $urlData[$competitor_website_list[$i]]['citation_flow'],
                    'trust_flow' => $urlData[$competitor_website_list[$i]]['trust_flow'],
                    'datetime' => now(),
                ]);
            }
        }
    }
}
