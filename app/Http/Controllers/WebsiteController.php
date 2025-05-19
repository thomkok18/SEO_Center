<?php

namespace App\Http\Controllers;

use App\Helpers\WebsiteScoreData;
use App\Http\Requests\Website\StoreWebsiteRequest;
use App\Http\Requests\Website\UpdateWebsiteRequest;
use App\Models\Budget;
use App\Models\ConclusionType;
use App\Models\MailToCompany;
use App\Models\PromotionUrl;
use App\Models\Role;
use App\Models\UrlType;
use App\Models\User;
use App\Models\Website;
use App\Models\WebsiteCheck;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of customer websites of a customer as a seo employee.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function index(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.index', [
            'websites' => Website::getCustomerWebsites($id),
            'customer_id' => $id
        ]);
    }

    /**
     * Display the specified customer website of a customer as a seo employee.
     *
     * @param int $customer_id
     * @param int $website_id
     * @return Application|Factory|View
     */
    public function show(int $customer_id, int $website_id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $budgets = Budget::getBudgetsByWebsiteId($website_id);
        $promotionUrls = PromotionUrl::getPromotionUrlTotalPricesByWebsiteId($website_id);

        $dates = [];
        $chartDates = [];
        $promotionUrlsTotalPrices = [];

        foreach($budgets as $key => $budget) {
            array_push($dates, $budget->date);
            array_push($chartDates,
                __('date.' . strtolower(date_format(date_create($budget->date), 'F')))
                . ' - ' .
                date_format(date_create($budget->date), 'Y')
            );

            // If there are no promotion urls yet for the selected customer website. Add 0 for each month.
            if (count($promotionUrls) > 0) {
                foreach($promotionUrls as $total) {
                    // If both "year - month" are the same. Add the total price of all promotion urls for selected month to array.
                    if (
                        __('date.' . strtolower(date_format(date_create($budget->date), 'F'))) . ' - ' . date_format(date_create($budget->date), 'Y') ===
                        __('date.' . strtolower(date_format(date_create($total->updated_at), 'F'))) . ' - ' . date_format(date_create($total->updated_at), 'Y')
                    ) {
                        array_push($promotionUrlsTotalPrices, $total->total_price);
                        break;
                    }

                    // If promotion url total price is not added yet after last index. Add 0.
                    if ($key === array_key_last($promotionUrls)) {
                        array_push($promotionUrlsTotalPrices, '0');
                    }
                }
            } else {
                array_push($promotionUrlsTotalPrices, '0');
            }
        }

        // Add 0 for each month promotion urls are not created.
        if (count($budgets) > count($promotionUrlsTotalPrices)) {
            for ($i = 0; count($budgets) > count($promotionUrlsTotalPrices); $i++) {
                array_push($promotionUrlsTotalPrices, '0');
            }
        }

        $backlinksAmount = [];
        $blogsAmount = [];
        $acceptedPromotionUrlsAmount = [];
        $deniedPromotionUrlsAmount = [];

        // Get amount of backlinks, blogs, accepted promotion urls and denied promotion urls for each month.
        foreach($dates as $key => $date) {
            if ($key + 1 < count($dates) && $date <= date('Y-m-d')) {
                array_push($backlinksAmount, PromotionUrl::countBacklinksBetweenDatesByCustomerId($customer_id, $date, $dates[$key + 1]));
                array_push($blogsAmount, PromotionUrl::countBlogsBetweenDatesByCustomerId($customer_id, $date, $dates[$key + 1]));
                array_push($acceptedPromotionUrlsAmount, PromotionUrl::countAcceptedPromotionUrlsBetweenDatesByCustomerId($customer_id, $date, $dates[$key + 1]));
                array_push($deniedPromotionUrlsAmount, PromotionUrl::countDeniedPromotionUrlsBetweenDatesByCustomerId($customer_id, $date, $dates[$key + 1]));
            }
        }

        return view('seo.customers.websites.budgets.show', [
            'customer_id' => $customer_id,
            'website' => Website::find($website_id),
            'websiteBudgetLeft' => Budget::getWebsiteBudget($website_id),
            'budgets' => $budgets,
            'promotionUrlsTotalPrices' => $promotionUrlsTotalPrices,
            'dates' => $chartDates,
            'backlinksAmount' => $backlinksAmount,
            'blogsAmount' => $blogsAmount,
            'acceptedPromotionUrlsAmount' => $acceptedPromotionUrlsAmount,
            'deniedPromotionUrlsAmount' => $deniedPromotionUrlsAmount,
        ]);
    }

    /**
     * Show the form for creating a new customer website as a seo employee.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function create(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.create', [
            'company_id' => $id
        ]);
    }

    /**
     * Store a newly created customer website as a seo employee.
     *
     * @param StoreWebsiteRequest $request
     * @return RedirectResponse
     */
    public function store(StoreWebsiteRequest $request, int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $website = Website::create($request->validated() + [
            'company_id' => $id,
            'archived' => false
        ]);

        $url = str_replace("www.","", parse_url($website->url, PHP_URL_HOST));

        WebsiteScoreData::indexation([$url]);

        if ($request->startdate === $request->enddate) {
            $daterange = [new DateTime($request->startdate)];
        } else {
            $daterange = new DatePeriod(
                new DateTime($request->startdate),
                new DateInterval('P1M'),
                new DateTime($request->enddate)
            );
        }

        foreach($daterange as $date) {
            if (Budget::websiteBudgetDateExists($website->id, $date->format("Y-m-d"))) {
                return redirect()->back()->withErrors(__('status.budget_date_already_exists'), 'websiteError');
            }
        }

        foreach($daterange as $date) {
            Budget::create([
                'website_id' => $website->id,
                'date' => $date->format("Y-m-d"),
                'amount' => $request->amount
            ]);
        }

        return redirect()->route('seo.customers.websites.index', $id)->with('status', [
            'storeWebsite' => __('status.website_store')
        ]);
    }

    /**
     * Show the form for editing a new customer website as a seo employee.
     *
     * @param int $customer_id
     * @param int $website_id
     * @return Application|Factory|View
     */
    public function edit(int $customer_id, int $website_id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.edit', [
            'website' => Website::find($website_id),
            'customer_id' => $customer_id
        ]);
    }

    /**
     * Update the specified mailto list in storage as a seo employee.
     *
     * @param UpdateWebsiteRequest $request
     * @param int $id
     * @return Application|Factory|View | RedirectResponse
     */
    public function update(UpdateWebsiteRequest $request, int $id): Application|Factory|View | RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $website = Website::find($id);

        $website->update([
            'url' => $request->url,
        ]);

        $url = str_replace("www.","", parse_url($website->url, PHP_URL_HOST));

        WebsiteScoreData::indexation([$url]);

        return redirect()->route('seo.customers.websites.index', $website->company_id)->with('status', [
            'updateWebsite' => __('status.website_update')
        ]);
    }

    /**
     * Remove the specified customer website from storage as a seo employee.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                new DateTime(Budget::getRecentBudgetByWebsiteId($id)->date) <= now()
            ),'403'
        );

        Budget::where('website_id', $id)->delete();

        Website::destroy($id);

        return back();
    }

    /**
     * Display a listing of the archived customer websites as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function archived(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.archive', [
            'websites' => Website::where('archived', '=', true)->paginate(20)
        ]);
    }

    /**
     * Archive the specified customer website from storage as a seo employee.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function archive(int $id): RedirectResponse
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                new DateTime(Budget::getRecentBudgetByWebsiteId($id)->date) > now()
            ),'403'
        );

        $website = Website::find($id);

        $website->archived = true;

        $website->save();

        return redirect()->route('seo.customers.websites.index', $website->company_id);
    }

    /**
     * Recover customer website from archive as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function recover(int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SEO,'403');

        $website = Website::find($id);

        $website->archived = false;

        $website->save();

        return view('seo.customers.websites.archive', [
            'websites' => Website::where('archived', '=', true)->paginate(20)
        ]);
    }

    /**
     * Search customer website as a customer.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function customerWebsiteSearch(Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::CUSTOMER, '403');

        return view('dashboards.customer', [
            'websites' => User::getCustomerSearchResults($request),
            'seoEmployees' => MailToCompany::getSEOByCompanyId(auth()->user()->company_id)
        ]);
    }

    /**
     * Display the promotion urls of the specified customer website as a customer.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function customerPromotionUrls(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::CUSTOMER, '403');

        return view('customer.promotion-urls.index', [
            'website' => Website::find($id),
            'promotionUrls' => PromotionUrl::getCustomerPromotionUrlsByWebsite($id),
            'urlTypes' => UrlType::all()
        ]);
    }

    /**
     * Display the history of the specified customer website score as a customer.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function customerWebsiteScore(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::CUSTOMER, '403');

        return view('customer.website-score.index', [
            'website' => Website::find($id),
            'checks' => WebsiteCheck::getWebsiteCheckHistoryByWebsite($id)
        ]);
    }

    /**
     * Search promotion urls in the promotion urls list of the customer website as a customer.
     *
     * @param int $id
     * @param Request $request
     * @return Application|Factory|View
     */
    public function promotionUrlSearch(int $id, Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::CUSTOMER, '403');

        return view('customer.promotion-urls.index', [
            'website' => Website::find($id),
            'urlTypes' => UrlType::all(),
            'promotionUrls' => PromotionUrl::getCustomerPromotionUrlSearchResults($id, $request),
            'conclusions' => ConclusionType::all()
        ]);
    }
}
