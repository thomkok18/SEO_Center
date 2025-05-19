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

class Admin_CompanyController extends Controller
{
    /**
     * Display a listing of companies as an admin.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.companies.index', [
            'companies' => Company::where('archived', '=', false)->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new company as an admin.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.companies.create');
    }

    /**
     * Store a newly created company in storage as an admin.
     *
     * @param  StoreCompanyRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        Company::create($request->validated() + [
            'archived' => false
        ]);

        return redirect()->route('admin.companies.index')->with('status', [
            'storeCompany' => __('status.company_store')
        ]);
    }

    /**
     * Search the specified company as an admin.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.companies.index', [
            'companies' => Company::getCompanySearchResults($request),
        ]);
    }

    /**
     * Show the form for editing the specified company as an admin.
     *
     * @param Company $company
     * @return Application|Factory|View
     */
    public function edit(Company $company): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.companies.edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified company in storage as an admin.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        $company->update($request->validated());

        return back()->with('status', [
            'updateCompany' => __('status.company_update')
        ]);
    }

    /**
     * Display a listing of the archived companies as an admin.
     *
     * @return Application|Factory|View
     */
    public function archived(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.companies.archive', [
            'companies' => Company::getCompanyArchivedResults(),
        ]);
    }

    /**
     * Recover company from archive as an admin.
     *
     * @param Company $company
     * @return Application|Factory|View
     */
    public function recover(Company $company): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN,'403');

        $company->archived = false;

        $company->save();

        return view('admin.companies.archive', [
            'companies' => Company::getCompanyArchivedResults(),
        ]);
    }
}
