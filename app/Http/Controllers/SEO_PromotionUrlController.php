<?php

namespace App\Http\Controllers;

use App\Exports\PromotionUrlsExport;
use App\Helpers\WebsiteScoreData;
use App\Http\Requests\SEO\StorePromotionUrlCheck;
use App\Http\Requests\SEO\UpdatePromotionUrl;
use App\Models\Check;
use App\Models\Company;
use App\Models\ConclusionType;
use App\Models\MajesticCheck;
use App\Models\MozCheck;
use App\Models\Observation;
use App\Models\ObservationCheck;
use App\Models\PriceType;
use App\Models\PromotionUrl;
use App\Models\PromotionUrlCheck;
use App\Models\Role;
use App\Models\UrlType;
use App\Models\WebCrawlerCheck;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SEO_PromotionUrlController extends Controller
{
    /**
     * Display a listing of the promotion urls as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getAllSeoPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Search promotion urls in the promotion urls list as a seo employee.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getSeoPromotionUrlSearchResults($request),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Check promotion urls as a seo employee.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function check(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $promotionUrl = PromotionUrl::find($id);

        // Get promotion url from the database if it exists already.
        $urlCheck = optional(Check::whereHas('promotionUrlCheck', function ($q) use ($id) {
            $q->where('promotion_url_id', $id);
        })->orderByDesc('checks.measured_at')->first())->toArray() ?? [];

        if (count($urlCheck) > 0) {
            // If promotion url is measured 14 days ago. Do new indexation request.
            if (strtotime($urlCheck['measured_at']) >= strtotime('-14 days')) {
                $url = str_replace("www.","", parse_url($promotionUrl->promotion_url, PHP_URL_HOST));

                WebsiteScoreData::indexation([$url]);
            }

            $majestic = MajesticCheck::find($urlCheck['majestic_check_id']);
            $moz = MozCheck::find($urlCheck['moz_check_id']);
            $webcrawler = WebCrawlerCheck::find($urlCheck['web_crawler_check_id']);

            $urlCheck = array_merge($urlCheck, [
                'moz_indexed_at' => $moz['indexed_at'],
                'domain_authority' => $moz['domain_authority'],
                'majestic_indexed_at' => $majestic['indexed_at'],
                'citation_flow' => $majestic['citation_flow'],
                'trust_flow' => $majestic['citation_flow'],
            ]);
        } else {
            $url = str_replace("www.","", parse_url($promotionUrl->promotion_url, PHP_URL_HOST));

            // Get promotion url data from api.
            $urlCheck = WebsiteScoreData::domains([$url]);

            // If api returns promotion url data.
            if ($urlCheck[$url]['moz_indexed_at'] && strtotime($urlCheck[$url]['moz_indexed_at']) < strtotime('7 days')) {
                $urlCheck = $urlCheck[$url];
            } else {
                // Do new indexation request to retrieve the data later.
                WebsiteScoreData::indexation([$url]);

                // Add empty data to show on the page.
                $urlCheck = [
                    'domain_authority' => null,
                    'citation_flow' => null,
                    'trust_flow' => null,
                    'majestic_indexed_at' => null,
                    'moz_indexed_at' => null,
                ];
            }
        }

        return view('seo.promotion-urls.check', [
            'promotionUrl' => $promotionUrl,
            'promotionUrlPrice' => $promotionUrl->price_type_id ? PriceType::find($promotionUrl->price_type_id) : null,
            'conclusion' => ConclusionType::find($promotionUrl->conclusion_id)->name,
            'company_supplier' => Company::find($promotionUrl->supplier_id),
            'company_customer' => Company::find($promotionUrl->customer_id),
            'observations' => Observation::all(),
            'observationChecks' => ObservationCheck::getObservationChecksByPromotionUrl($id),
            'conclusionTypes' => ConclusionType::all(),
            'check' => PromotionUrlCheck::getCheckByPromotionUrl($promotionUrl->id),
            'apiData' => $urlCheck,
            'newPromotionUrl' => PromotionUrl::getFirstPendingPromotionUrl($id)
        ]);
    }

    /**
     * Save the rating of a Promotion url as a seo employee.
     *
     * @param StorePromotionUrlCheck $request
     * @param UpdatePromotionUrl $promotionUrlRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function assessment(StorePromotionUrlCheck $request, UpdatePromotionUrl $promotionUrlRequest, int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $promotionUrl = PromotionUrl::find($id);

        $promotionUrl->update($promotionUrlRequest->validated() + [
            'conclusion_id' => $request->conclusionRadios,
        ]);

        // TODO: Add webcrawler data.
        $webCrawler = WebCrawlerCheck::create([
            'domain_name' => '',
            'server_ip' => '',
            'http_status' => '',
            'page_language' => '',
            'page_title' => '',
            'page_description' => '',
            'measured_at' => '',
            'follow_internal_links' => '',
            'no_follow_internal_links' => '',
            'follow_external_links' => '',
            'no_follow_external_links' => '',
            'follow_social_links' => '',
            'no_follow_social_links' => '',
            'follow_customer_links' => '',
            'no_follow_customer_links' => '',
            'follow_competitor_links' => '',
            'no_follow_competitor_links' => '',
            'image_count' => '',
        ]);

        $moz = MozCheck::create([
            'domain_name' => $request->domain_name,
            'domain_authority' => $request->domain_authority,
            'indexed_at' => $request->moz_indexed_at,
        ]);

        $majestic = MajesticCheck::create([
            'domain_name' => $request->domain_name,
            'citation_flow' => $request->citation_flow,
            'trust_flow' => $request->trust_flow,
            'indexed_at' => $request->majestic_indexed_at,
        ]);

        $check = Check::create($request->validated() + [
            'user_id' => auth()->user()->id,
            'web_crawler_check_id' => $webCrawler->id,
            'moz_check_id' => $moz->id,
            'majestic_check_id' => $majestic->id,
            'measured_at' => now(),
        ]);

        PromotionUrlCheck::create([
            'promotion_url_id' => $id,
            'check_id' => $check->id
        ]);

        $promotionUrlObservations = [];

        foreach($request->observationCheckboxes ?? [] as $observationId) {
            array_push($promotionUrlObservations, [
                'observation_id' => $observationId,
                'check_id' => $check->id
            ]);
        }

        DB::table('observation_checks')->insert($promotionUrlObservations);

        $newPromotionUrlCheck = PromotionUrl::getFirstPendingPromotionUrl($id);

        if ($request->submit === 'next' && isset($newPromotionUrlCheck)) {
            return redirect(route('seo.promotion-urls.check', ['promotion_url' => $newPromotionUrlCheck->id]));
        } else {
            return redirect(route('seo.promotion-urls.index'));
        }
    }

    /**
     * Check promotion url as a seo employee.
     */
    public function checking(int $id): Factory|View|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $promotionUrl = PromotionUrl::find($id);

        $url = str_replace("www.","", parse_url($promotionUrl->promotion_url, PHP_URL_HOST));

        // Get promotion url data from api.
        $urlCheck = WebsiteScoreData::domains([$url]);

        // If api returns promotion url data.
        if ($urlCheck[$url]['moz_indexed_at'] && strtotime($urlCheck[$url]['moz_indexed_at']) < strtotime('7 days')) {
            $urlCheck = $urlCheck[$url];
        } else {
            // Do new indexation request to retrieve the data later.
            WebsiteScoreData::indexation([$url]);

            // Get promotion url data from database or add empty data to show on the page.
            $urlCheck = optional(Check::whereHas('promotionUrlCheck', function ($q) use ($id) {
                    $q->where('promotion_url_id', $id);
                })->orderByDesc('checks.measured_at')->first())->toArray() ?? [
                'domain_authority' => null,
                'citation_flow' => null,
                'trust_flow' => null,
                'majestic_indexed_at' => null,
                'moz_indexed_at' => null,
            ];
        }

        return view('seo.promotion-urls.check', [
            'promotionUrl' => $promotionUrl,
            'promotionUrlPrice' => $promotionUrl->price_type_id ? PriceType::find($promotionUrl->price_type_id) : null,
            'conclusion' => ConclusionType::find($promotionUrl->conclusion_id)->name,
            'company_supplier' => Company::find($promotionUrl->supplier_id),
            'company_customer' => Company::find($promotionUrl->customer_id),
            'observations' => Observation::all(),
            'observationChecks' => ObservationCheck::getObservationChecksByPromotionUrl($id),
            'conclusionTypes' => ConclusionType::all(),
            'check' => PromotionUrlCheck::getCheckByPromotionUrl($promotionUrl->id),
            'apiData' => $urlCheck
        ]);
    }

    /**
     * Download promotion urls showed in the view as excel file as a seo employee.
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function download(Request $request): BinaryFileResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $promotionUrls = PromotionUrl::getSeoPromotionUrlSearchResults($request);

        $csv = [
            [
                __('role.customer'),
                trans_choice('promotionUrl.customer_website', 1),
                __('role.supplier'),
                __('promotionUrl.promotion_url'),
                __('promotionUrl.url_type_id'),
                __('promotionUrl.price'),
                __('promotionUrl.conclusion'),
                __('promotionUrl.archived'),
            ]
        ];

        foreach ($promotionUrls as $promotionUrl) {
            array_push($csv, [
                'customer' =>  $promotionUrl->customer_name,
                'website' =>  $promotionUrl->url,
                'supplier' =>  $promotionUrl->supplier_name,
                'promotion_url' =>  $promotionUrl->promotion_url,
                'url_type' =>  trans_choice('title.' . $promotionUrl->type, 1),
                'custom_price' =>  $promotionUrl->custom_price ? $promotionUrl->custom_price : PriceType::find($promotionUrl->price_type_id)->price,
                'conclusion' =>  __('conclusion_types.' . ConclusionType::getConclusionNameById($promotionUrl->conclusion_id)->name),
                'archived' =>  $promotionUrl->archived ? __('modal.yes') : __('modal.no'),
            ]);
        }

        return Excel::download(new PromotionUrlsExport($csv), 'promotion_urls.xlsx');
    }
}
