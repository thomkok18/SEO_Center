<?php

namespace App\Http\Controllers;

use App\Helpers\WebsiteScoreData;
use App\Http\Requests\Import\CsvImportRequest;
use App\Http\Requests\PromotionUrl\StorePromotionUrlRequest;
use App\Http\Requests\PromotionUrl\UpdatePromotionUrlRequest;
use App\Imports\PromotionUrlsImport;
use App\Models\Company;
use App\Models\ConclusionType;
use App\Models\ImportData;
use App\Models\Observation;
use App\Models\ObservationCheck;
use App\Models\PriceType;
use App\Models\PromotionUrl;
use App\Models\PromotionUrlCheck;
use App\Models\Role;
use App\Models\UrlType;
use App\Models\User;
use App\Models\Website;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class Supplier_PromotionUrlController extends Controller
{
    /**
     * Display a listing of the promotion urls as a supplier.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getAllSupplierPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Display an archived listing of the promotion url as a supplier.
     *
     * @return Application|Factory|View
     */
    public function archived(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.archive', [
            'promotionUrls' => PromotionUrl::getAllSupplierArchivedPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Search promotion urls in the promotion urls list as a supplier.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getSupplierPromotionUrlSearchResults($request),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Show the form for creating a new promotion url as a supplier.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.create', [
            'customers' => Company::getAllCustomerCompanies(),
            'urlTypes' => UrlType::all(),
            'websites' => [],
            'priceTypes' => PriceType::all()
        ]);
    }

    /**
     * Search customer urls by customer in the create page as a supplier.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function createSearch(Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.create', [
            'customers' => Company::getAllCustomerCompanies(),
            'urlTypes' => UrlType::all(),
            'websites' => Company::getCustomerWebsitesByCompanies($request->input('customer_id')),
            'priceTypes' => PriceType::all()
        ]);
    }

    /**
     * Store a newly created promotion url in storage as a supplier.
     *
     * @param StorePromotionUrlRequest $request
     * @return RedirectResponse
     */
    public function store(StorePromotionUrlRequest $request): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        $duplicatePromotionUrl = PromotionUrl::where('promotion_url', '=', $request->promotion_url)
            ->where('customer_id', '=', Website::getCompanyByWebsite($request->input('website_id')))
            ->where('archived', '=', false)
            ->exists();

        // If promotion url is a duplicate return error message.
        if ($duplicatePromotionUrl) {
            return redirect()->back()->withErrors(__('status.duplicate_promotion_url_error'), 'promotionUrlError');
        }

        $existingPromotionUrl = PromotionUrl::where('promotion_url', '=', $request->promotion_url)->exists();

        PromotionUrl::create($request->validated() + [
            'supplier_id' => auth()->user()->company_id,
            'customer_id' => Website::getCompanyByWebsite($request->input('website_id')),
            'conclusion_id' => ConclusionType::PENDING,
            'website_id' => Website::find($request->input('website_id')),
            'price_type_id' => $request->input('custom_price') ? null : $request->input('price_type_id'),
            'custom_price' => $request->input('custom_price'),
            'archived' => false
        ]);

        // If promotion url is not in the database. Send indexation request to api.
        if (!$existingPromotionUrl) {
            $url = str_replace("www.","", parse_url($request->promotion_url, PHP_URL_HOST));

            WebsiteScoreData::indexation([$url]);
        }

        return redirect()->route('supplier.promotion-urls.index')->with('status', ['storePromotionUrls' => __('status.promotion_urls_store')]);
    }

    /**
     * Show the form for editing the specified promotion url as a supplier.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.edit', [
            'promotionUrl' => PromotionUrl::find($id),
            'customers' => Company::getAllCustomerCompanies(),
            'urlTypes' => UrlType::all(),
            'websites' => Company::getCustomerWebsitesByCompanies(PromotionUrl::find($id)->customer_id),
            'priceTypes' => PriceType::all()
        ]);
    }

    /**
     * Search customer urls by customer in the edit page as a supplier.
     *
     * @param Request $request
     * @param int $id
     * @return Application|Factory|View
     */
    public function editSearch(Request $request, int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.edit', [
            'promotionUrl' => PromotionUrl::find($id),
            'customers' => Company::getAllCustomerCompanies(),
            'urlTypes' => UrlType::all(),
            'websites' => Company::getCustomerWebsitesByCompanies($request->input('customer_id')),
            'priceTypes' => PriceType::all()
        ]);
    }

    /**
     * Update the specified promotion url in storage as a supplier.
     *
     * @param  UpdatePromotionUrlRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdatePromotionUrlRequest $request, int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        $duplicatePromotionUrl = PromotionUrl::where('promotion_url', '=', $request->promotion_url)
            ->where('customer_id', '=', Website::getCompanyByWebsite($request->input('website_id')))
            ->where('archived', '=', false)
            ->where('id', '!=', $id)
            ->exists();

        // If promotion url is a duplicate return error message.
        if ($duplicatePromotionUrl) {
            return redirect()->back()->withErrors(__('status.duplicate_promotion_url_error'), 'promotionUrlError');
        }

        $promotionUrl = PromotionUrl::find($id);

        $existingPromotionUrl = PromotionUrl::where('promotion_url', '=', $request->promotion_url)->exists();

        // If promotion url has pending status. You may update the customer id and website id.
        if ($promotionUrl->conclusion_id === ConclusionType::PENDING) {
            $promotionUrl->update($request->validated() + [
                'customer_id' => Website::getCompanyByWebsite($request->input('website_id')),
                'website_id' => $request->input('website_id') ? Website::find($request->input('website_id'))->id : null,
                'price_type_id' => $request->input('custom_price') ? null : $request->input('price_type_id'),
                'custom_price' => $request->input('custom_price'),
            ]);
        }

        // If promotion url not equal to the submitted promotion url or does not exist in the database. Send indexation request.
        if ($promotionUrl->promotion_url !== $request->promotion_url && !$existingPromotionUrl) {
            $url = str_replace("www.","", parse_url($request->promotion_url, PHP_URL_HOST));

            WebsiteScoreData::indexation([$url]);
        }

        return back()->with('status', ['updatePromotionUrl' => __('status.promotion_url_update')]);
    }

    /**
     * Display the specified promotion url check result as a supplier.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SUPPLIER ||
                PromotionUrlCheck::where('promotion_url_id', '=', $id)->doesntExist()
            ),'403'
        );

        $promotionUrl = PromotionUrl::find($id);

        $check = PromotionUrlCheck::getCheckByPromotionUrl($promotionUrl->id);

        return view('supplier.promotion-urls.show', [
            'promotionUrl' => $promotionUrl,
            'observations' => Observation::all(),
            'observationChecks' => ObservationCheck::getObservationChecksByPromotionUrl($id),
            'conclusionTypes' => ConclusionType::all(),
            'check' => $check,
            'seo_employee' => User::find($check->user_id),
            'customer' => Company::getCompanyByUserId($promotionUrl->customer_id)[0],
            'urlTypes' => UrlType::all(),
            'websites' => Company::getCustomerWebsitesByCompanies(PromotionUrl::find($id)->customer_id)
        ]);
    }

    /**
     * Update promotion url status to pending again in storage as a supplier.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function resubmit(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        $promotionUrl = PromotionUrl::find($id);

        $promotionUrl->update([
            'conclusion_id' => ConclusionType::PENDING,
        ]);

        return view('supplier.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getAllSupplierPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Remove the specified promotion url from storage as a supplier.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function destroy(int $id): Application|Factory|View
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SUPPLIER ||
                PromotionUrlCheck::where('promotion_url_id', '=', $id)->exists()
            ),'403'
        );

        PromotionUrl::destroy($id);

        return view('supplier.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getAllSupplierPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Archive the specified promotion url from storage as a supplier.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function archive(int $id): Application|Factory|View
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SUPPLIER ||
                PromotionUrlCheck::where('promotion_url_id', '=', $id)->doesntExist()
            ),'403'
        );

        $promotionUrl = PromotionUrl::find($id);

        $promotionUrl->archived = true;

        $promotionUrl->save();

        return view('supplier.promotion-urls.index', [
            'promotionUrls' => PromotionUrl::getAllSupplierPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Recover promotion url from archive as a supplier.
     *
     * @param  int  $id
     * @return Application|Factory|View | RedirectResponse
     */
    public function recover(int $id): Application|Factory|View | RedirectResponse
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SUPPLIER ||
                PromotionUrlCheck::where('promotion_url_id', '=', $id)->doesntExist()
            ),'403'
        );

        $promotionUrl = PromotionUrl::find($id);

        $duplicatePromotionUrl = PromotionUrl::where('promotion_url', '=', $promotionUrl->promotion_url)
            ->where('customer_id', '=', Website::getCompanyByWebsite($promotionUrl->website_id))
            ->where('archived', '=', false)
            ->where('id', '!=', $id)
            ->exists();

        // If promotion url is a duplicate return error message.
        if ($duplicatePromotionUrl) {
            return redirect()->back()->withErrors(__('status.duplicate_recover_promotion_url_error'), 'promotionUrlError');
        }

        $promotionUrl->archived = false;

        $promotionUrl->save();

        return view('supplier.promotion-urls.archive', [
            'promotionUrls' => PromotionUrl::getAllSupplierArchivedPromotionUrls(),
            'urlTypes' => UrlType::all(),
            'conclusions' => ConclusionType::all()
        ]);
    }

    /**
     * Import promotion urls as a supplier.
     *
     * @return Application|Factory|View
     */
    public function getImport(): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        return view('supplier.promotion-urls.import');
    }

    /**
     * Parsing imported promotion urls data as a supplier.
     *
     * @param CsvImportRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function parseImport(CsvImportRequest $request): Application|Factory|View | RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SUPPLIER, '403');

        $path = $request->file('data')->getRealPath();

        // Two ways to retrieve the data from the file depending on if the header is present.
        if ($request->has('header')) {
            $data = Excel::toArray(new PromotionUrlsImport(), $request->file('data'))[0];
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        // Remove these fields from the promotion url data.
        $document_fields = array_values(array_diff(Schema::getColumnListing('promotion_urls'), [
            'id',
            'supplier_id',
            'conclusion_id',
            'archived',
            'created_at',
            'updated_at',
        ]));

        // If data is present. Save the file data into the database.
        if (count($data) > 0) {
            $csv_data = array_slice($data, 0);

            $csv_data_file = ImportData::create([
                'name' => $request->file('data')->getClientOriginalName(),
                'header' => $request->has('header'),
                'data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('supplier.promotion-urls.import-fields', compact( 'document_fields', 'csv_data', 'csv_data_file'));
    }

    /**
     * Store promotion url data of a csv file as a supplier.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function processImport(Request $request): RedirectResponse
    {
        $promotionUrls = ImportData::find($request->data_file_id);

        $csv_data = json_decode($promotionUrls->data, true);

        // If header exists. Remove those values.
        if ($promotionUrls->header) {
            array_shift($csv_data);
        }

        $urls = [];
        $duplicates = 0;

        foreach ($csv_data as $row) {
            $promotionUrl = new PromotionUrl();

            // Add data fields for each row to an empty promotion url.
            foreach ($request->fields as $index => $field) {
                $promotionUrl->$field = $row[$index];
            }

            // Check if the data of the file is correct and is not altered compared to the database data.
            if (
                count(Company::getCompanyByCompanyId($promotionUrl->customer_id)) <= 0 ||
                count(Website::getWebsiteIdByWebsiteUrl($promotionUrl->website_id)) <= 0 ||
                count(UrlType::getUrlTypeIdByUrlTypeName($promotionUrl->url_type_id)) <= 0
            ) {
                return redirect(route('supplier.promotion-urls.import'))->withErrors([__('status.import_promotion_urls_error')]);
            }

            // Add promotion url data.
            $promotionUrl->customer_id = Company::getCompanyByCompanyId($promotionUrl->customer_id)[0]->id;
            $promotionUrl->website_id = Website::getWebsiteIdByWebsiteUrl($promotionUrl->website_id)[0]->id;
            $promotionUrl->url_type_id = UrlType::getUrlTypeIdByUrlTypeName($promotionUrl->url_type_id)[0]->id;
            $promotionUrl->supplier_id = auth()->user()->company_id;
            $promotionUrl->conclusion_id = ConclusionType::PENDING;
            $promotionUrl->archived = false;

            $duplicatePromotionUrl = PromotionUrl::where('promotion_url', '=', $promotionUrl->promotion_url)
                ->where('customer_id', '=', Website::getCompanyByWebsite($promotionUrl->website_id))
                ->where('archived', '=', false)
                ->exists();

            // Count duplicates or save promotion url.
            if ($duplicatePromotionUrl) {
                $duplicates++;
            } else {
                $promotionUrl->save();

                $url = str_replace("www.","", parse_url($row[3], PHP_URL_HOST));
                array_push($urls, $url);
            }
        }

        ImportData::destroy($promotionUrls->id);

        // Send indexation request for each promotion url.
        WebsiteScoreData::indexation(array_unique($urls));

        // Return warning with amount of duplicate promotion urls if they exist.
        if ($duplicates > 0) {
            return redirect(route('supplier.promotion-urls.index'))->with('warning', ['promotionUrl' => trans_choice('status.duplicate_promotion_urls_warning', $duplicates, ['amount' => $duplicates])]);
        }

        return redirect(route('supplier.promotion-urls.index'))->with('status', ['storePromotionUrls' => __('status.promotion_urls_store')]);
    }
}
