<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mailto\StoreMailtoRequest;
use App\Http\Requests\Mailto\UpdateMailtoRequest;
use App\Models\Company;
use App\Models\MailToCompany;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MailToCompanyController extends Controller
{
    /**
     * Display a listing of the companies to add seo employee mails to it as a seo employee.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function index(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.customers.websites.mailto.index', [
            'mails' => MailToCompany::getMailsByCompanyId($id),
            'customer_id' => $id
        ]);
    }

    /**
     * Show the form for adding a mailto list to a customer as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function create(int $id): View|Factory|Application
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                count(MailToCompany::findCompanyId($id)) > 0
            ), '403'
        );

        return view('seo.customers.websites.mailto.create', [
            'customer' => Company::find($id),
            'seo_users' => User::getAllSEOUsers(),
            'customer_id' => $id
        ]);
    }

    /**
     * Store a newly created mailto list in storage as a seo employee.
     *
     * @param StoreMailtoRequest $request
     * @param int $id
     * @return Application|Factory|View | RedirectResponse
     */
    public function store(StoreMailtoRequest $request, int $id): Application|Factory|View | RedirectResponse
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                count(MailToCompany::findCompanyId($id)) > 0
            ), '403'
        );

        // If nothing is selected add all seo employee mails to customer support mail list.
        if ($request->user_ids[0] === null) {
            foreach(User::getAllSEOUsers() as $user) {
                MailToCompany::create([
                    'company_id' => $id,
                    'user_id' => $user->id,
                ]);
            }
        } else {
            foreach($request->user_ids as $user_id) {
                MailToCompany::create([
                    'company_id' => $id,
                    'user_id' => $user_id,
                ]);
            }
        }

        return redirect()->route('seo.customers.mailto.index', $id)->with('status', [
            'storeMailto' => __('status.mailto_store')
        ]);
    }

    /**
     * Show the form for editing the specified mailto list as a seo employee.
     *
     * @param int $customer_id
     * @return Application|Factory|View
     */
    public function edit(int $customer_id): View|Factory|Application
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                count(MailToCompany::findCompanyId($customer_id)) === 0
            ), '403'
        );

        $emails = MailToCompany::where('company_id', '=', $customer_id)->get();

        if (User::getAllSEOUsers()->count() === MailToCompany::where('company_id', '=', $customer_id)->get()->count()) {
            $emails = [];
        }

        return view('seo.customers.websites.mailto.edit', [
            'customer' => Company::find($customer_id),
            'seo_users' => User::getAllSEOUsers(),
            'emails' => $emails
        ]);
    }

    /**
     * Update the specified mailto list in storage as a seo employee.
     *
     * @param UpdateMailtoRequest $request
     * @param int $id
     * @return Application|Factory|View | RedirectResponse
     */
    public function update(UpdateMailtoRequest $request, int $id): Application|Factory|View | RedirectResponse
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                count(MailToCompany::findCompanyId($id)) === 0
            ), '403'
        );

        MailToCompany::where('company_id', '=', $id)->delete();

        // If no mail is selected it will default to all seo employee mails.
        if ($request->user_ids === null) {
            return redirect()->route('seo.customers.mailto.index')->with('status', [
                'updateMailto' => __('status.mailto_update')
            ]);
        }

        // Check if all mails is selected or else find the users.
        $users = $request->user_ids[0] === null ? User::getAllSEOUsers() : User::find($request->user_ids);

        // Add user mails to customer.
        foreach($users as $user) {
            MailToCompany::create([
                'company_id' => $id,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('seo.customers.mailto.index', $id)->with('status', [
            'updateMailto' => __('status.mailto_update')
        ]);
    }
}
