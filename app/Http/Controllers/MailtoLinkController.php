<?php

namespace App\Http\Controllers;

use App\Http\Requests\Crawler\StoreMailRequest;
use App\Http\Requests\Crawler\UpdateMailRequest;
use App\Mail\LinkCrawlerMail;
use App\Models\Link;
use App\Models\MailtoLink;
use App\Models\Role;
use App\Models\User;
use DOMDocument;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailtoLinkController extends Controller
{
    /**
     * Display a listing of mails as an admin.
     *
     */
    public function index(): Factory|View|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.mailto.index', [
            'mails' => MailtoLink::paginate(20),
        ]);
    }

    /**
     * Show the form for adding a mail as an admin.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.mailto.create');
    }

    /**
     * Store a newly created mail in storage as an admin.
     *
     * @param StoreMailRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMailRequest $request): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        MailtoLink::create($request->validated());

        return redirect()->route('admin.mailto_link.index')->with('status', [
            'storeMailto' => __('status.mailto_store_admin')
        ]);
    }

    /**
     * Search the specified mail as an admin.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.mailto.index', [
            'mails' => MailtoLink::getMailSearchResults($request),
        ]);
    }

    /**
     * Show the form for editing the specified mail as an admin.
     *
     * @param MailtoLink $mailtoLink
     * @return Application|Factory|View
     */
    public function edit(MailtoLink $mailtoLink): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.mailto.edit', [
            'mail' => $mailtoLink,
        ]);
    }

    /**
     * Update the specified mail in storage as an admin.
     *
     * @param UpdateMailRequest $request
     * @param MailtoLink $mailtoLink
     * @return RedirectResponse
     */
    public function update(UpdateMailRequest $request, MailtoLink $mailtoLink): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        $mailtoLink->update($request->validated());

        return back()->with('status', [
            'updateMailto' => __('status.mailto_update_admin')
        ]);
    }

    /**
     * Remove the specified mail from storage as an admin.
     *
     */
    public function destroy(int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        MailtoLink::destroy($id);

        return view('admin.links.mailto.index', [
            'mails' => MailtoLink::paginate(20),
        ]);
    }
}
