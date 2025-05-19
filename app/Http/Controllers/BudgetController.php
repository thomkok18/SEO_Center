<?php

namespace App\Http\Controllers;

use App\Http\Requests\Budget\StoreBudgetRequest;
use App\Http\Requests\Budget\UpdateBudgetRequest;
use App\Models\Budget;
use App\Models\PromotionUrl;
use App\Models\Role;
use App\Models\Website;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BudgetController extends Controller
{
    /**
     * Display a listing of the budgets as a suppliers.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function index(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        $budgets = Budget::getBudgetsByWebsiteId($id);
        $promotionUrls = PromotionUrl::getPromotionUrlTotalPricesByWebsiteId($id);

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
                array_push($backlinksAmount, PromotionUrl::countBacklinksBetweenDatesByCustomerId($id, $date, $dates[$key + 1]));
                array_push($blogsAmount, PromotionUrl::countBlogsBetweenDatesByCustomerId($id, $date, $dates[$key + 1]));
                array_push($acceptedPromotionUrlsAmount, PromotionUrl::countAcceptedPromotionUrlsBetweenDatesByCustomerId($id, $date, $dates[$key + 1]));
                array_push($deniedPromotionUrlsAmount, PromotionUrl::countDeniedPromotionUrlsBetweenDatesByCustomerId($id, $date, $dates[$key + 1]));
            }
        }

        return view('supplier.website-budget.index', [
            'websiteBudgetLeft' => Budget::getWebsiteBudget($id),
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
     * Show the form for creating a customer website budget as a seo employee.
     *
     * @param int $customer_id
     * @param int $website_id
     * @return Application|Factory|View
     */
    public function create(int $customer_id, int $website_id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.budgets.create', [
            'customer_id' => $customer_id,
            'website_id' => $website_id
        ]);
    }

    /**
     * Store a newly created customer website budget in storage as a seo employee.
     *
     * @param StoreBudgetRequest $request
     * @param int $customer_id
     * @param int $website_id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreBudgetRequest $request, int $customer_id, int $website_id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

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
            if (Budget::websiteBudgetDateExists($website_id, $date->format("Y-m-d"))) {
                return redirect()->back()->withErrors(__('status.budget_date_already_exists'), 'budgetError');
            }
        }

        foreach($daterange as $date) {
            Budget::create([
                'website_id' => $website_id,
                'date' => $date->format("Y-m-d"),
                'amount' => $request->amount
            ]);
        }

        return redirect()->route('seo.customers.websites.show', ['customer' => $customer_id, 'website' => $website_id])->with('status', [
            'storeBudget' => __('status.budget_store')
        ]);
    }

    /**
     * Show the form for editing a customer website budget as a seo employee.
     *
     * @param int $customer_id
     * @param int $website_id
     * @param int $budget_id
     * @return Application|Factory|View
     */
    public function edit(int $customer_id, int $website_id, int $budget_id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.budgets.edit', [
            'customer_id' => $customer_id,
            'website_id' => $website_id,
            'budget' => Budget::find($budget_id)
        ]);
    }

    /**
     * Update the specified customer website budget in storage as a seo employee.
     *
     * @param UpdateBudgetRequest $request
     * @param int $customer_id
     * @param int $website_id
     * @param int $budget_id
     * @return RedirectResponse
     */
    public function update(UpdateBudgetRequest $request, int $customer_id, int $website_id, int $budget_id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $budget = Budget::find($budget_id);

        $budget->update([
            'amount' => $request->amount,
        ]);

        return redirect()->route('seo.customers.websites.show', ['customer' => $customer_id, 'website' => $website_id])->with('status', [
            'updateBudget' => __('status.budget_update')
        ]);
    }

    /**
     * Remove the specified customer website budget from storage as a seo employee.
     *
     * @param int $customer_id
     * @param int $website_id
     * @param int $budget_id
     * @return RedirectResponse
     */
    public function destroy(int $customer_id, int $website_id, int $budget_id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO,'403');

        $budget = Budget::find($budget_id);

        if (new DateTime($budget->date) > now()) {
            Budget::destroy($budget_id);

            return redirect()->route('seo.customers.websites.show', ['customer' => $customer_id, 'website' => $website_id])->with('status', [
                'updateBudget' => __('status.budget_destroy')
            ]);
        } else {
            return redirect()->back()->withErrors(__('status.budget_too_old'), 'budgetError');
        }
    }
}
