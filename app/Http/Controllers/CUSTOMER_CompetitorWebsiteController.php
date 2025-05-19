<?php

namespace App\Http\Controllers;

use App\Models\CompetitorWebsite;
use App\Models\Role;
use App\Models\WebsiteCheck;
use App\Models\WebsiteCompetitorCheck;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CUSTOMER_CompetitorWebsiteController extends Controller
{
    /**
     * Display a listing of competitors for a customer as a customer.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::CUSTOMER, '403');

        return view('customer.competitors.index', [
            'competitors' => CompetitorWebsite::getCompetitorsByCustomerId(auth()->user()->company_id)
        ]);
    }

    /**
     * Display the specified competitor as a customer.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::CUSTOMER, '403');

        $checks = [];

        // Get competitor website checks and customer website checks.
        $checks['competitor'] = WebsiteCompetitorCheck::getWebsiteCheckHistoryByWebsite($id)->toArray();
        $checks['customer'] = WebsiteCheck::getWebsiteCheckHistoryByCompany(auth()->user()->company_id)->toArray();

        $dates = [];

        // Get all competitor website check dates.
        foreach ($checks['competitor'] as $check) {
            array_push($dates, $check->datetime);
        }

        // Get all customer website check dates.
        foreach ($checks['customer'] as $check) {
            array_push($dates, $check->datetime);
        }

        // Sort dates for chart.
        usort($dates, fn($a, $b) => strtotime($a) - strtotime($b));

        // Remove duplicate dates for chart.
        $dates = array_values(array_unique($dates));

        $customerWebsites = [];

        // Get customer website urls.
        foreach ($checks['customer'] as $customerWebsite) {
            array_push($customerWebsites, $customerWebsite->url);
        }

        // Remove duplicate customer website urls.
        $customerWebsites = array_values(array_unique($customerWebsites));

        $customerWebsiteChecks = [];

        // Customer website checks are split and missing dates are added and sorted.
        foreach ($customerWebsites as $customerWebsite) {
            $customerWebsiteChecks[$customerWebsite] = [];

            // Split customer website checks based on customer website url.
            foreach ($checks['customer'] as $customerWebsiteResult) {
                if ($customerWebsite === $customerWebsiteResult->url) {
                    array_push($customerWebsiteChecks[$customerWebsite], $customerWebsiteResult);
                }
            }

            $datetimes = [];

            // Get all datetimes from customer websites.
            foreach ($customerWebsiteChecks[$customerWebsite] as $object) {
                $datetimes[$object->datetime] = $object;
            }

            // Add empty data when date does not exist in the customer website checks.
            foreach ($dates as $date) {
                if (!isset($datetimes[$date])) {
                    array_push($customerWebsiteChecks[$customerWebsite], (object) [
                        'datetime' => $date
                    ]);
                }
            }

            // Sort customer website checks by datetime.
            usort($customerWebsiteChecks[$customerWebsite], fn($a, $b) => strcmp($a->datetime, $b->datetime));
        }

        return view('customer.competitors.show', [
            'competitor' => CompetitorWebsite::find($id),
            'competitorChecks' => WebsiteCompetitorCheck::getWebsiteCheckHistoryByWebsite($id),
            'customerWebsiteChecks' => $customerWebsiteChecks,
            'dates' => $dates
        ]);
    }
}
