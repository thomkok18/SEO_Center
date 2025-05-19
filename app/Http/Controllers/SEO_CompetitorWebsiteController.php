<?php

namespace App\Http\Controllers;

use App\Helpers\WebsiteScoreData;
use App\Http\Requests\Competitor\StoreCompetitorRequest;
use App\Http\Requests\Competitor\UpdateCompetitorRequest;
use App\Models\CompetitorWebsite;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SEO_CompetitorWebsiteController extends Controller
{
    /**
     * Display a listing of competitors for a customer as a seo employee.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function index(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.competitors.index', [
            'competitors' => CompetitorWebsite::getCompetitorsByCustomerId($id),
            'customer_id' => $id
        ]);
    }

    /**
     * Show the form for creating a new competitor as a seo employee.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function create(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.competitors.create', [
            'customer_id' => $id
        ]);
    }

    /**
     * Store a newly created customer website as a seo employee.
     *
     * @param StoreCompetitorRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store(StoreCompetitorRequest $request, int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        CompetitorWebsite::create([
            'customer_id' => $id,
            'url' => $request->input('url')
        ]);

        $url = str_replace("www.","", parse_url($request->input('url'), PHP_URL_HOST));

        WebsiteScoreData::indexation([$url]);

        return redirect()->route('seo.customers.competitors.index', $id)->with('status', [
            'storeCompetitor' => __('status.competitor_store')
        ]);
    }

    /**
     * Show the form for editing the specified competitor website as a seo employee.
     *
     * @param int $customer_id
     * @param int $competitor_id
     * @return Application|Factory|View
     */
    public function edit(int $customer_id, int $competitor_id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.competitors.edit', [
            'competitor' => CompetitorWebsite::find($competitor_id),
            'customer_id' => $customer_id
        ]);
    }

    /**
     * Update the specified promotion url price in storage as a seo employee.
     *
     * @param UpdateCompetitorRequest $request
     * @param int $customer_id
     * @param int $competitor_id
     * @return RedirectResponse
     */
    public function update(UpdateCompetitorRequest $request, int $customer_id, int $competitor_id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $competitor = CompetitorWebsite::find($competitor_id);

        $competitor->update($request->validated());

        return redirect()->route('seo.customers.competitors.edit', [$customer_id, $competitor_id])->with('status', [
            'updateCompetitor' => __('status.competitor_update')
        ]);
    }
}
