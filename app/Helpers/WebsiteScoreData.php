<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WebsiteScoreData
{
    /**
     * Retrieve Website score data of a specific domain.
     *
     * @param array $urls
     * @return array
     */
    public static function domains(array $urls): array
    {
        $majestic = Http::withBasicAuth(
            config('scores.api.username'),
            config('scores.api.password')
        )->post(config('scores.url.majestic'), [
            'domains' => $urls
        ])->json();

        $moz = Http::withBasicAuth(
            config('scores.api.username'),
            config('scores.api.password')
        )->post(config('scores.url.moz'), [
            'targets' => $urls
        ])->json();

        $data = [];

        foreach($urls as $url) {
            $data = array_merge($data, [$url => [
                'citation_flow' => $majestic[$url]['data']['majestic_citation_flow'],
                'trust_flow' => $majestic[$url]['data']['majestic_trust_flow'],
                'majestic_indexed_at' => $majestic[$url]['data']['majestic_indexed_at'],
                'domain_authority' => $moz[$url]['moz_domain_authority'],
                'moz_indexed_at' => $moz[$url]['moz_indexed_at']
            ]]);
        }

        return $data;
    }

    /**
     * Send indexation request to api to retrieve new website score next time.
     *
     * @param array $urls
     * @return void
     */
    public static function indexation(array $urls)
    {
        Http::withBasicAuth(
            config('scores.api.username'),
            config('scores.api.password')
        )->post(config('scores.url.moz'), [
            'targets' => $urls,
            'datasource' => 'fresh'
        ])->json();
    }
}
