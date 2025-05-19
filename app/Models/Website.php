<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Website extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'url',
        'archived',
    ];

    /**
     * Get the promotion url that the website owns.
     *
     * @return BelongsTo
     */
    public function promotionUrl(): BelongsTo
    {
        return $this->belongsTo(PromotionUrl::class);
    }

    /**
     * Get the website that the company owns.
     *
     * @return HasMany
     */
    public function company(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the invoice websites that the website owns.
     *
     * @return HasMany
     */
    public function invoiceWebsite(): HasMany
    {
        return $this->hasMany(InvoiceWebsite::class);
    }

    /**
     * Get the website check that the website owns.
     *
     * @return HasMany
     */
    public function websiteCheck(): HasMany
    {
        return $this->hasMany(WebsiteCheck::class);
    }

    /**
     * Get company_id by customer website.
     *
     * @param int|null $website_id
     * @return mixed
     */
    public static function getCompanyByWebsite(int|null $website_id): mixed
    {
        if ($website_id) {
            return DB::table('websites')->select('company_id')->where('id', '=', $website_id)->get()[0]->company_id;
        }

        return null;
    }

    /**
     * Get website id by website url.
     *
     * @param string $website_url
     * @return array
     */
    public static function getWebsiteIdByWebsiteUrl(string $website_url): array
    {
        return DB::table('websites')->select('id')->where('url', '=', $website_url)->get()->toArray();
    }

    /**
     * Get all customer websites by company id.
     *
     * @param int $company_id
     * @return LengthAwarePaginator
     */
    public static function getCustomerWebsites(int $company_id): LengthAwarePaginator
    {
        $websites =  DB::table('websites')
            ->join('budgets', 'websites.id', '=', 'budgets.website_id')
            ->where('company_id', '=', $company_id)
            ->where('websites.archived', '=', false)
            ->select('websites.*', 'budgets.amount', 'budgets.date')
            ->latest('budgets.date')
            ->groupBy(
                'websites.url',
            )
            ->paginate(20);

        foreach ($websites as $index => $website) {
            $websites[$index]->budget_amount = Budget::getWebsiteBudget($website->id);
            $websites[$index]->blog_amount = Website::getCustomerWebsiteBlogs($website->id)->count();
            $websites[$index]->backlink_amount = Website::getCustomerWebsiteBacklinks($website->id)->count();
            $websites[$index]->domain_authority = WebsiteCheck::where('website_id', $website->id)->orderBy('datetime','DESC')->first()->domain_authority ?? '?';
            $websites[$index]->trust_flow = WebsiteCheck::where('website_id', $website->id)->orderBy('datetime','DESC')->first()->trust_flow ?? '?';
            $websites[$index]->citation_flow = WebsiteCheck::where('website_id', $website->id)->orderBy('datetime','DESC')->first()->citation_flow ?? '?';
        }

        return $websites;
    }

    /**
     * Get accepted blogs for a website.
     *
     * @param int $website_id
     * @return Collection
     */
    public static function getCustomerWebsiteBlogs(int $website_id): Collection
    {
        return DB::table('websites')
            ->join('promotion_urls', 'websites.id', '=', 'promotion_urls.website_id')
            ->where('promotion_urls.website_id', '=', $website_id)
            ->where('promotion_urls.url_type_id', '=', PromotionUrl::BLOG)
            ->where('promotion_urls.conclusion_id', '=', ConclusionType::ACCEPTED)
            ->get();
    }

    /**
     * Get accepted backlinks for a website.
     *
     * @param int $website_id
     * @return Collection
     */
    public static function getCustomerWebsiteBacklinks(int $website_id): Collection
    {
        return DB::table('websites')
            ->join('promotion_urls', 'websites.id', '=', 'promotion_urls.website_id')
            ->where('promotion_urls.website_id', '=', $website_id)
            ->where('promotion_urls.url_type_id', '=', PromotionUrl::BACKLINK)
            ->where('promotion_urls.conclusion_id', '=', ConclusionType::ACCEPTED)
            ->get();
    }
}
