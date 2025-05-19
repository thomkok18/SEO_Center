<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ChangeUserRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Budget;
use App\Models\Company;
use App\Models\Language;
use App\Models\MailToCompany;
use App\Models\PromotionUrl;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Models\Website;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display the dashboard of the user when logged in.
     *
     * @return View | RedirectResponse
     */
    public function index(): View | RedirectResponse
    {
        if (auth()->user()->status_id === Status::DISABLED) {
            auth()->logout();
            return redirect()->route('login')->withErrors(['errors' => __('auth.failed')]);
        }

        return match (auth()->user()->role_id) {
            Role::ADMIN => view('dashboards.admin', [
                'users' => User::getAllUsers(),
                'roles' => Role::all(),
                'statuses' => Status::all()
            ]),
            Role::SUPPLIER => view('dashboards.supplier', [
                'newAssessedBlogs' => PromotionUrl::getAssessedBlogs(),
                'newAssessedBacklinks' => PromotionUrl::getAssessedBacklinks(),
                'totalBudgetLeft' => Budget::getTotalBudget(),
                'websites' => Website::paginate(20)
            ]),
            Role::SEO => view('dashboards.seo', [
                'newBlogs' => PromotionUrl::getNewBlogs(),
                'newBacklinks' => PromotionUrl::getNewBacklinks(),
                'changedBlogs' => PromotionUrl::getChangedBlogs(),
                'changedBacklinks' => PromotionUrl::getChangedBacklinks()
            ]),
            Role::CUSTOMER => view('dashboards.customer', [
                'websites' => Website::getCustomerWebsites(auth()->user()->company_id),
                'seoEmployees' => MailToCompany::getSEOByCompanyId(auth()->user()->company_id)
            ]),
            default => redirect()->route('login')->withErrors(['errors' => __('auth.whoops')]),
        };
    }

    /**
     * Search users in admin dashboard.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('dashboards.admin', [
            'users' => User::getAdminSearchResults($request),
            'roles' => Role::all(),
            'statuses' => Status::all()
        ]);
    }

    /**
     * Show the form for creating a new user as an admin.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.users.create', [
            'languages' => Language::all(),
            'roles' => Role::all(),
            'statuses' => Status::all(),
            'companies' => Company::all()
        ]);
    }

    /**
     * Store a newly created user as an admin.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        User::create($request->validated());

        return redirect()->route('dashboard')->with('status', [
            'storeAccount' => __('status.account_store')
        ]);
    }

    /**
     * Display the profile page of a logged in user.
     *
     * @return Application|Factory|View
     */
    public function show(): Application|Factory|View
    {
        return view('profile.show', [
            'languages' => Language::all()
        ]);
    }

    /**
     * Show the form for editing the specified user as an admin.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user): Factory|View|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'languages' => Language::all(),
            'statuses' => Status::all(),
            'companies' => Company::all()
        ]);
    }

    /**
     * Update user info in the admin page.
     *
     * @param ChangeUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(ChangeUserRequest $request, User $user): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        $user->update($request->validated());

        if (auth()->id() === $user->id) {
            Session::put('locale', Language::getLanguageCodeById($user->language_id));
        }

        return back()->with('status', ['updateAccount' => __('status.account_update')]);
    }

    /**
     * Update user info in the profile page.
     *
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function updateInfo(UpdateUserRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $user->update($request->validated());

        Session::put('locale', Language::getLanguageCodeById($user->language_id));

        return back()->with('status', ['updateProfile' => __('status.profile_update')]);
    }

    /**
     * Update user password in the profile page.
     *
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        auth()->user()->update($request->validated());

        return back()->with('status', ['updatePassword' => __('status.password_update')]);
    }
}
