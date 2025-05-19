<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\SEO\StoreCustomerRequest;
use App\Models\Company;
use App\Models\Language;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SEO_CompanyController extends Controller
{


    /**
     * Display a listing of companies as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.index', [
            'customers' => Company::getAllCustomerCompanies(),
        ]);
    }

    /**
     * Show the form for creating a new company as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.create', [
            'languages' => Language::all()
        ]);
    }

    /**
     * Store a newly created company with user in storage as a seo employee.
     *
     * @param StoreCompanyRequest $companyRequest
     * @param StoreCustomerRequest $customerRequest
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $companyRequest, StoreCustomerRequest $customerRequest): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $customer = Company::create($companyRequest->validated() + [
            'archived' => false
        ]);

        User::create($customerRequest->validated() + [
            'status_id' => Status::ENABLED,
            'role_id' => Role::CUSTOMER,
            'company_id' => $customer->id,
        ]);

        return redirect()->route('seo.customers.index')->with('status', [
            'storeCustomer' => __('status.customer_store')
        ]);
    }

    /**
     * Show the form for editing the specified company as a seo employee.
     *
     * @param Company $customer
     * @return Application|Factory|View
     */
    public function edit(Company $customer): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.edit', [
            'company' => $customer,
        ]);
    }

    /**
     * Update the specified company in storage as an admin.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $customer
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $customer): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $customer->update($request->validated());

        return back()->with('status', [
            'updateCompany' => __('status.company_update')
        ]);
    }

    /**
     * Display a listing of the archived companies as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function archived(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.archive', [
            'companies' => Company::getCompanyArchivedResults(),
        ]);
    }

    /**
     * Recover company from archive as a seo employee.
     *
     * @param Company $customer
     * @return Application|Factory|View
     */
    public function recover(Company $customer): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SEO,'403');

        $customer->archived = false;

        $customer->save();

        return view('seo.customers.archive', [
            'companies' => Company::getCompanyArchivedResults(),
        ]);
    }
}
