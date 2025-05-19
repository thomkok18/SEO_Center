<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PromotionUrl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'supplier_id',
        'url_type_id',
        'conclusion_id',
        'price_type_id',
        'website_id',
        'promotion_url',
        'custom_price',
        'archived',
    ];

    /**
     * Get the company that the promotion url owns.
     *
     * @return HasMany
     */
    public function company(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the promotion url check that the promotion url owns.
     *
     * @return HasMany
     */
    public function promotionUrlCheck(): HasMany
    {
        return $this->hasMany(PromotionUrlCheck::class);
    }

    /**
     * Get the conclusion type that the promotion url owns.
     *
     * @return BelongsTo
     */
    public function conclusionType(): BelongsTo
    {
        return $this->belongsTo(ConclusionType::class);
    }

    /**
     * Get the website that the promotion url owns.
     *
     * @return HasMany
     */
    public function website(): HasMany
    {
        return $this->hasMany(Website::class);
    }

    /**
     * Get the url type that the promotion url owns.
     *
     * @return BelongsTo
     */
    public function urlType(): BelongsTo
    {
        return $this->belongsTo(UrlType::class);
    }

    /**
     * Get total price of all promotion urls each month by website.
     *
     * @param int $website_id
     * @return array
     */
    public static function getPromotionUrlTotalPricesByWebsiteId(int $website_id): array
    {
        return DB::table('promotion_urls')
            ->join('price_types', 'promotion_urls.price_type_id', '=', 'price_types.id')
            ->where('promotion_urls.website_id', $website_id)
            ->where('promotion_urls.conclusion_id', ConclusionType::ACCEPTED)
            ->select(
                DB::raw(
                    'promotion_urls.updated_at as updated_at,
                    IFNULL(SUM(promotion_urls.custom_price), 0) + IFNULL(SUM(price_types.price), 0) as total_price'
                )
            )
            ->groupBy('promotion_urls.updated_at')
            ->get()
            ->toArray();
    }

    /**
     * Get all promotion urls by company name for the supplier.
     *
     * @return LengthAwarePaginator
     */
    public static function getAllSupplierPromotionUrls(): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('websites', 'promotion_urls.website_id', '=', 'websites.id')
            ->join('companies as suppliers', 'promotion_urls.supplier_id', '=', 'suppliers.id')
            ->join('conclusion_types as conclusion', 'promotion_urls.conclusion_id', '=', 'conclusion.id')
            ->leftJoin('companies as customers', 'promotion_urls.customer_id', '=', 'customers.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->select('promotion_urls.*',
                'suppliers.name as supplier_name',
                'url_types.name as type',
                'customers.name as customer_name',
                'websites.url',
            )
            ->where('suppliers.id', '=', 1)
            ->where('promotion_urls.archived', '=', false)
            ->paginate(20);
    }

    /**
     * Get all promotion urls by company name for the supplier.
     *
     * @return LengthAwarePaginator
     */
    public static function getAllSupplierArchivedPromotionUrls(): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('websites', 'promotion_urls.website_id', '=', 'websites.id')
            ->join('companies as suppliers', 'promotion_urls.supplier_id', '=', 'suppliers.id')
            ->join('conclusion_types as conclusion', 'promotion_urls.conclusion_id', '=', 'conclusion.id')
            ->leftJoin('companies as customers', 'promotion_urls.customer_id', '=', 'customers.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->select('promotion_urls.*',
                'suppliers.name as supplier_name',
                'url_types.name as type',
                'customers.name as customer_name',
                'websites.url',
            )
            ->where('suppliers.id', '=', auth()->user()->company_id)
            ->where('promotion_urls.archived', '=', true)
            ->paginate(20);
    }

    /**
     * Get all promotion urls by company name for the supplier.
     *
     * @return LengthAwarePaginator
     */
    public static function getAllSeoPromotionUrls(): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('websites', 'promotion_urls.website_id', '=', 'websites.id')
            ->join('companies as suppliers', 'promotion_urls.supplier_id', '=', 'suppliers.id')
            ->join('conclusion_types as conclusion', 'promotion_urls.conclusion_id', '=', 'conclusion.id')
            ->join('companies as customers', 'promotion_urls.customer_id', '=', 'customers.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->select('promotion_urls.*',
                'suppliers.name as supplier_name',
                'url_types.name as type',
                'customers.name as customer_name',
                'websites.url',
            )
            ->whereNotNull('promotion_urls.customer_id')
            ->where('promotion_urls.archived', '=', false)
            ->paginate(20);
    }

    /**
     * Get search results of promotion urls from the promotion urls list.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getSupplierPromotionUrlSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('websites', 'promotion_urls.website_id', '=', 'websites.id')
            ->join('companies as suppliers', 'promotion_urls.supplier_id', '=', 'suppliers.id')
            ->join('conclusion_types as conclusion', 'promotion_urls.conclusion_id', '=', 'conclusion.id')
            ->leftJoin('companies as customers', 'promotion_urls.customer_id', '=', 'customers.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->select('promotion_urls.*',
                'suppliers.name as supplier_name',
                'url_types.name as type',
                'customers.name as customer_name',
                'websites.url',
            )
            ->where('suppliers.id', '=', auth()->user()->company_id)
            ->where('promotion_urls.archived', '=', false)
            ->where('promotion_urls.url_type_id', 'like', '%' . $request->url_type_id . '%')
            ->where('promotion_urls.conclusion_id', 'like', '%' . $request->conclusion_id . '%')
            ->where(function($query) use ($request) {
                if($request->checked === '1') {
                    $query->whereIn('promotion_urls.id', DB::table('promotion_url_checks')->pluck('promotion_url_id'));
                } elseif ($request->checked === '0') {
                    $query->whereNotIn('promotion_urls.id', DB::table('promotion_url_checks')->pluck('promotion_url_id'));
                }
            })
            ->where(function($query) use ($request) {
                foreach($request->conclusion_ids as $conclusion_id) {
                    $query->orWhere('promotion_urls.conclusion_id', 'like', '%' . $conclusion_id . '%');
                }
            })
            ->where(function($query) use ($request) {
                $query->orWhere('customers.name', 'like', '%' . $request->search . '%')
                    ->orWhere('promotion_urls.promotion_url', 'like', '%' . $request->search . '%')
                    ->orWhere('websites.url', 'like', '%' . $request->search . '%');
            })
            ->orderBy('promotion_urls.promotion_url', $request->alphabetical)
            ->orderBy('promotion_urls.updated_at', $request->order)
            ->paginate(20);
    }

    /**
     * Get search results of promotion urls from the promotion urls list.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getSeoPromotionUrlSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('websites', 'promotion_urls.website_id', '=', 'websites.id')
            ->join('companies as suppliers', 'promotion_urls.supplier_id', '=', 'suppliers.id')
            ->join('conclusion_types as conclusion', 'promotion_urls.conclusion_id', '=', 'conclusion.id')
            ->leftJoin('companies as customers', 'promotion_urls.customer_id', '=', 'customers.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->select('promotion_urls.*',
                'suppliers.name as supplier_name',
                'url_types.name as type',
                'customers.name as customer_name',
                'websites.url',
            )
            ->whereNotNull('promotion_urls.customer_id')
            ->where('promotion_urls.archived', '=', false)
            ->where('promotion_urls.url_type_id', 'like', '%' . $request->url_type_id . '%')
            ->where(function($query) use ($request) {
                if($request->checked === '1') {
                    $query->whereIn('promotion_urls.id', DB::table('promotion_url_checks')->pluck('promotion_url_id'));
                } elseif ($request->checked === '0') {
                    $query->whereNotIn('promotion_urls.id', DB::table('promotion_url_checks')->pluck('promotion_url_id'));
                }
            })
            ->where(function($query) use ($request) {
                foreach($request->conclusion_ids as $conclusion_id) {
                    $query->orWhere('promotion_urls.conclusion_id', 'like', '%' . $conclusion_id . '%');
                }
            })
            ->where(function($query) use ($request) {
                $query->orWhere('customers.name', 'like', '%' . $request->search . '%')
                    ->orWhere('suppliers.name', 'like', '%' . $request->search . '%')
                    ->orWhere('promotion_urls.promotion_url', 'like', '%' . $request->search . '%')
                    ->orWhere('websites.url', 'like', '%' . $request->search . '%');
            })
            ->orderBy('promotion_urls.promotion_url', $request->alphabetical)
            ->orderBy('promotion_urls.updated_at', $request->order)
            ->paginate(20);
    }

    /**
     * Get blogs without a check by the SEO employee.
     *
     * @return mixed
     */
    public static function getNewBlogs(): mixed
    {
        return PromotionUrl::doesnthave('promotionUrlCheck')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->where('url_types.id', '=', PromotionUrl::BLOG)
            ->get()
            ->toArray();
    }

    /**
     * Get backlinks without a check by the SEO employee.
     *
     * @return mixed
     */
    public static function getNewBacklinks(): mixed
    {
        return PromotionUrl::doesnthave('promotionUrlCheck')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->where('url_types.id', '=', PromotionUrl::BACKLINK)
            ->get()
            ->toArray();
    }

    /**
     * Get blogs with one or more checks by the SEO employee.
     *
     * @return mixed
     */
    public static function getChangedBlogs(): mixed
    {
        return PromotionUrl::has('promotionUrlCheck')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->where('url_types.id', '=', PromotionUrl::BLOG)
            ->get()
            ->toArray();
    }

    /**
     * Get backlinks with one or more checks by the SEO employee.
     *
     * @return mixed
     */
    public static function getChangedBacklinks(): mixed
    {
        return PromotionUrl::has('promotionUrlCheck')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->where('url_types.id', '=', PromotionUrl::BACKLINK)
            ->get()
            ->toArray();
    }

    /**
     * Get assessed blogs if not pending or accepted which are from the logged in supplier.
     *
     * @return mixed
     */
    public static function getAssessedBlogs(): mixed
    {
        return PromotionUrl::has('promotionUrlCheck')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->join('conclusion_types', 'promotion_urls.conclusion_id', '=', 'conclusion_types.id')
            ->where('url_types.id', '=', PromotionUrl::BLOG)
            ->where('promotion_urls.supplier_id', '=', auth()->user()->company_id)
            ->where('conclusion_types.id', '!=', ConclusionType::PENDING)
            ->where('conclusion_types.id', '!=', ConclusionType::ACCEPTED)
            ->get()
            ->toArray();
    }

    /**
     * Get assessed backlinks if not pending or accepted which are from the logged in supplier.
     *
     * @return mixed
     */
    public static function getAssessedBacklinks(): mixed
    {
        return PromotionUrl::has('promotionUrlCheck')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->join('conclusion_types', 'promotion_urls.conclusion_id', '=', 'conclusion_types.id')
            ->where('url_types.id', '=', PromotionUrl::BACKLINK)
            ->where('promotion_urls.supplier_id', '=', auth()->user()->company_id)
            ->where('conclusion_types.id', '!=', ConclusionType::PENDING)
            ->where('conclusion_types.id', '!=', ConclusionType::ACCEPTED)
            ->get()
            ->toArray();
    }

    /**
     * Get all customer promotion urls for the customer website.
     *
     * @param int $id
     * @return LengthAwarePaginator
     */
    public static function getCustomerPromotionUrlsByWebsite(int $id): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('promotion_url_checks', 'promotion_urls.id', '=', 'promotion_url_checks.promotion_url_id')
            ->join('checks', 'promotion_url_checks.check_id', '=', 'checks.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->where('promotion_urls.archived', '=', false)
            ->where('promotion_urls.customer_id', '=', auth()->user()->company_id)
            ->where('promotion_urls.website_id', '=', $id)
            ->where('promotion_urls.conclusion_id', '=', ConclusionType::ACCEPTED)
            ->select(DB::raw(
                'promotion_urls.promotion_url,
                url_types.name as name,
                max(checks.measured_at) as measured_at'
            ))
            ->groupBy(
                'promotion_urls.promotion_url',
            )
            ->paginate(20);
    }

    /**
     * Get search results of promotion urls from the promotion urls list of a customer website.
     *
     * @param int $id
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getCustomerPromotionUrlSearchResults(int $id, Request $request): LengthAwarePaginator
    {
        return DB::table('promotion_urls')
            ->join('promotion_url_checks', 'promotion_urls.id', '=', 'promotion_url_checks.promotion_url_id')
            ->join('checks', 'promotion_url_checks.check_id', '=', 'checks.id')
            ->join('url_types', 'promotion_urls.url_type_id', '=', 'url_types.id')
            ->where('promotion_urls.archived', '=', false)
            ->where('promotion_urls.customer_id', '=', auth()->user()->company_id)
            ->where('promotion_urls.website_id', '=', $id)
            ->where('promotion_urls.conclusion_id', '=', ConclusionType::ACCEPTED)
            ->where('promotion_urls.url_type_id', 'like', '%' . $request->url_type_id . '%')
            ->where(function($query) use ($request) {
                $query->orWhere('promotion_urls.promotion_url', 'like', '%' . $request->search . '%');
            })
            ->select(DB::raw(
                'promotion_urls.promotion_url,
                url_types.name as name,
                max(checks.measured_at) as measured_at'
            ))
            ->groupBy(
                'promotion_urls.promotion_url',
            )
            ->paginate(20);
    }

    /**
     * Get amount of backlinks between dates by customer id.
     *
     * @param int $id
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public static function countBacklinksBetweenDatesByCustomerId(int $id, string $startDate, string $endDate): int
    {
        return DB::table('promotion_urls')
            ->where('customer_id', $id)
            ->where('url_type_id', 2)
            ->whereBetween('updated_at', [date($startDate), date($endDate)])
            ->count();
    }

    /**
     * Get amount of blogs between dates by customer id.
     *
     * @param int $id
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public static function countBlogsBetweenDatesByCustomerId(int $id, string $startDate, string $endDate): int
    {
        return DB::table('promotion_urls')
            ->where('customer_id', $id)
            ->where('url_type_id', 1)
            ->whereBetween('updated_at', [date($startDate), date($endDate)])
            ->count();
    }

    /**
     * Get amount of accepted promotion urls between dates by customer id.
     *
     * @param int $id
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public static function countAcceptedPromotionUrlsBetweenDatesByCustomerId(int $id, string $startDate, string $endDate): int
    {
        return DB::table('promotion_urls')
            ->where('customer_id', $id)
            ->where('conclusion_id', ConclusionType::ACCEPTED)
            ->whereBetween('updated_at', [date($startDate), date($endDate)])
            ->count();
    }

    /**
     * Get amount of denied promotion urls between dates by customer id.
     *
     * @param int $id
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public static function countDeniedPromotionUrlsBetweenDatesByCustomerId(int $id, string $startDate, string $endDate): int
    {
        return DB::table('promotion_urls')
            ->where('customer_id', $id)
            ->where('conclusion_id', ConclusionType::DENIED)
            ->whereBetween('updated_at', [date($startDate), date($endDate)])
            ->count();
    }

    /**
     * Get a promotion url with pending conclusion type without selected promotion url.
     *
     * @param int $id
     * @return stdClass | null
     */
    public static function getFirstPendingPromotionUrl(int $id): stdClass | null
    {
        return DB::table('promotion_urls')
            ->where('conclusion_id', ConclusionType::PENDING)
            ->where('id', '<>',$id)
            ->where('archived', false)
            ->first();
    }

    /**
     * Specific promotion urls types.
     *
     * @var int
     */
    public const BLOG = 1;
    public const BACKLINK = 2;
}
