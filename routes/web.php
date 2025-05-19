<?php

use App\Http\Controllers\Admin_CompanyController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CUSTOMER_CompetitorWebsiteController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MailToCompanyController;
use App\Http\Controllers\MailtoLinkController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\PriceTypeController;
use App\Http\Controllers\SEO_CompanyController;
use App\Http\Controllers\SEO_CompetitorWebsiteController;
use App\Http\Controllers\SEO_PromotionUrlController;
use App\Http\Controllers\Supplier_PromotionUrlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'language', 'cache.headers:private;no_cache'])->group(function () {
    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/profile', 'show')->name('profile');
        Route::patch('/profile/user-info/update', 'updateInfo')->name('user.info.update');
        Route::patch('/profile/password/update', 'updatePassword')->name('user.password.update');
        Route::get('/dashboard/search/user', 'search')->name('admin.users.search');

        Route::resource('users', UserController::class)->except(['index', 'show', 'destroy']);
    });

    Route::prefix('admin')->as('admin.')->group(function () {
        // Companies
        Route::controller(Admin_CompanyController::class)->group(function () {
            Route::get('/companies/archived', 'archived')->name('companies.archived');
            Route::post('/companies/{company}/recover', 'recover')->name('companies.recover');
            Route::get('/companies/search', 'search')->name('companies.search');

            Route::resource('companies', Admin_CompanyController::class)->except(['show', 'destroy']);
        });

        // Links
        Route::controller(LinkController::class)->group(function () {
            Route::get('/links/search', 'search')->name('links.search');
            Route::get('/links/import', 'getImport')->name('links.import');
            Route::post('/links/parse-import', 'parseImport')->name('links.parse-import');
            Route::post('/links/process-import', 'processImport')->name('links.process-import');

            Route::resource('links', LinkController::class);
        });

        // Crawler mailto.
        Route::controller(MailtoLinkController::class)->group(function () {
            Route::get('/web-crawler/mailto_link/search', 'search')->name('mailto_link.search');

            Route::resource('web-crawler/links/mailto_link', MailtoLinkController::class)->except(['show']);
        });
    });

    Route::prefix('seo')->as('seo.')->group(function () {
        // SEO_Company.
        Route::controller(SEO_CompanyController::class)->group(function () {
            Route::get('/customers/archived', 'archived')->name('customers.archived');
            Route::post('/customers/{customer}/recover', 'recover')->name('customers.recover');

            Route::resource('customers', SEO_CompanyController::class)->except(['show', 'destroy']);
        });

        // Budget
        Route::resource('customers.websites.budgets', BudgetController::class)->except(['show']);

        // MailToCompany
        Route::controller(MailToCompanyController::class)->group(function () {
            Route::get('/customers/{customer}/mailto/edit', 'edit')->name('customers.mailto.edit');
            Route::patch('/customers/{customer}/mailto', 'update')->name('customers.mailto.update');

            Route::resource('customers.mailto', MailToCompanyController::class)->only(['index', 'create', 'store']);
        });

        // SEO_PromotionUrl.
        Route::controller(SEO_PromotionUrlController::class)->group(function () {
            Route::get('/promotion-urls/download', 'download')->name('promotion-urls.download');
            Route::get('/promotion-urls/search', 'search')->name('promotion-urls.search');
            Route::get('/promotion-urls/{promotion_url}/check', 'check')->name('promotion-urls.check');
            Route::get('/promotion-urls/{promotion_url}/checking', 'checking')->name('promotion-urls.checking');
            Route::post('/promotion-urls/{promotion_url}/assessment', 'assessment')->name('promotion-urls.assessment');

            Route::resource('promotion-urls', SEO_PromotionUrlController::class)->only(['index']);
        });

        // Observation.
        Route::controller(ObservationController::class)->group(function () {
            Route::get('/observations/search', 'search')->name('observations.search');
            Route::get('/observations/archived', 'archived')->name('observations.archived');
            Route::post('/observations/{observation}/archive', 'archive')->name('observations.archive');
            Route::post('/observations/{observation}/recover', 'recover')->name('observations.recover');

            Route::resource('observations', ObservationController::class)->except(['show']);
        });

        // Website.
        Route::controller(WebsiteController::class)->group(function () {
            Route::get('/customers/websites/{website}/archived', 'archived')->name('customers.websites.archived');
            Route::post('/customers/websites/{website}/archive', 'archive')->name('customers.websites.archive');
            Route::post('/customers/websites/{website}/recover', 'recover')->name('customers.websites.recover');

            Route::resource('customers.websites', WebsiteController::class);
        });

        // PriceType.
        Route::controller(PriceTypeController::class)->group(function () {
            Route::get('/price-types/archived', 'archived')->name('price-types.archived');
            Route::post('/price-types/{price_type}/archive', 'archive')->name('price-types.archive');
            Route::post('/price-types/{price_type}/recover', 'recover')->name('price-types.recover');

            Route::resource('price-types', PriceTypeController::class)->except(['show']);
        });

        // SEO_CompetitorWebsite.
        Route::resource('customers.competitors', SEO_CompetitorWebsiteController::class)->except(['show', 'destroy']);
    });

    Route::prefix('supplier')->as('supplier.')->group(function () {
        // Budget.
        Route::resource('websites.budgets', BudgetController::class)->only(['index']);

        // Supplier_PromotionUrl.
        Route::controller(Supplier_PromotionUrlController::class)->group(function () {
            Route::get('/promotion-urls/search', 'search')->name('promotion-urls.search');
            Route::get('/promotion-urls/create-search', 'createSearch')->name('promotion-urls.create-search');
            Route::get('/promotion-urls/{promotion_url}/edit-search', 'editSearch')->name('promotion-urls.edit-search');
            Route::get('/promotion-urls/import', 'getImport')->name('promotion-urls.import');
            Route::post('/promotion-urls/parse-import', 'parseImport')->name('promotion-urls.parse-import');
            Route::post('/promotion-urls/process-import', 'processImport')->name('promotion-urls.process-import');
            Route::get('/promotion-urls/archived', 'archived')->name('promotion-urls.archived');
            Route::post('/promotion-urls/{promotion_url}/archive', 'archive')->name('promotion-urls.archive');
            Route::post('/promotion-urls/{promotion_url}/recover', 'recover')->name('promotion-urls.recover');
            Route::post('/promotion-urls/{promotion_url}/resubmit', 'resubmit')->name('promotion-urls.resubmit');

            Route::resource('promotion-urls', Supplier_PromotionUrlController::class);
        });
    });

    Route::prefix('customer')->as('customer.')->group(function () {
        // Website.
        Route::controller(WebsiteController::class)->group(function () {
            Route::get('/dashboard/search/website', 'customerWebsiteSearch')->name('websites.search');
            Route::get('/websites/{website}/promotion-urls', 'customerPromotionUrls')->name('promotion-urls');
            Route::get('/websites/{website}/promotion-urls/search', 'promotionUrlSearch')->name('promotion-urls.search');
            Route::get('/websites/{website}/score', 'customerWebsiteScore')->name('website-score');
        });

        // CUSTOMER_CompetitorWebsite.
        Route::resource('competitors', CUSTOMER_CompetitorWebsiteController::class)->only(['index', 'show']);
    });
});

require __DIR__ . '/auth.php';
