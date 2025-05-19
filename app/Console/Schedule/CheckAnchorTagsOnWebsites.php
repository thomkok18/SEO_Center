<?php

namespace App\Console\Schedule;

use App\Mail\LinkCrawlerMail;
use App\Models\Link;
use App\Models\MailtoLink;
use App\Models\User;
use DOMDocument;
use Illuminate\Support\Facades\Mail;

class CheckAnchorTagsOnWebsites
{
    /**
     * Delete csv files from database older than a day.
     *
     * @return void
     */
    public function __invoke()
    {
        $links = Link::all();

        // All recipients who has to see the results of the link crawler.
        $recipientMails = MailtoLink::all();

        if (count($recipientMails) > 0) {
            if (count($links) > 0) {
                $websiteAnchors = [];

                // Combine all anchor tags to the website you want to search.
                foreach ($links as $link) {
                    $websiteAnchors[$link->website][] = [
                        'website' => $link->website,
                        'anchor_text' => $link->anchor_text,
                        'anchor_url' => $link->anchor_url
                    ];
                }

                $anchorsFound = [];
                $anchorsMissing = [];
                $anchorsUnableToLoad = [];

                // Go through every website we want to crawl.
                foreach (Link::getAllUniqueWebsiteUrls() as $uniqueWebsite) {
                    $curl = curl_init($uniqueWebsite->website);

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

                    $data = curl_exec($curl);

                    // Hide HTML warnings
                    libxml_use_internal_errors(true);

                    // Go through every anchor tag included on the website and find them.
                    foreach ($websiteAnchors[$uniqueWebsite->website] as $websiteAnchor) {
                        if (count($websiteAnchors[$uniqueWebsite->website]) > 0) {
                            $dom = new DOMDocument;

                            // Check if html data is retrieved from curl.
                            if ($dom->loadHTML($data, LIBXML_NOWARNING)) {
                                // Go through each a tag found in the html data.
                                foreach ($dom->getElementsByTagName('a') as $a) {
                                    $href = $a->getAttribute('href');
                                    $anchorText = $a->nodeValue;

                                    // If anchor tag is found.
                                    if ($href === $websiteAnchor['anchor_url'] && $anchorText === $websiteAnchor['anchor_text']) {
                                        $anchorsFound[] = $websiteAnchor;
                                        break;
                                    }
                                }

                                // If anchor tag is not found.
                                $anchorsMissing[] = $websiteAnchor;
                            } else {
                                // Website failed to load html.
                                $anchorsUnableToLoad[] = $websiteAnchor;
                            }
                        }
                    }
                }

                foreach ($recipientMails as $recipient) {
                    $user = [
                        'firstname' => $recipient->firstname,
                        'inserts' => $recipient->inserts,
                        'lastname' => $recipient->lastname,
                        'email' => $recipient->email,
                    ];

                    Mail::to(new User($user))->send(
                        new LinkCrawlerMail($recipient, $anchorsFound, $anchorsMissing, $anchorsUnableToLoad)
                    );
                }
            } else {
                foreach ($recipientMails as $recipient) {
                    $user = [
                        'firstname' => $recipient->firstname,
                        'inserts' => $recipient->inserts,
                        'lastname' => $recipient->lastname,
                        'email' => $recipient->email,
                    ];

                    Mail::to(new User($user))->send(
                        new LinkCrawlerMail($recipient, 0, 0, 0)
                    );
                }
            }
        }
    }
}
