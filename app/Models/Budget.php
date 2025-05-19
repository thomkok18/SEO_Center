<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

class Budget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'date',
        'amount',
    ];

    /**
     * Get the total budget left to assign new promotion urls for.
     *
     * @return mixed
     */
    public static function getTotalBudget(): mixed
    {
        $totalBudget = DB::table('budgets')
            ->join('websites', 'budgets.website_id', '=', 'websites.id')
            ->where('websites.archived', false)
            ->sum('budgets.amount');

        $UrlCustomPrices = DB::table('promotion_urls')
            ->orWhere('conclusion_id', '=', ConclusionType::PENDING)
            ->orWhere('conclusion_id', '=', ConclusionType::ACCEPTED)
            ->sum('custom_price');

        $UrlTypePrices = DB::table('promotion_urls')
            ->join('price_types', 'promotion_urls.price_type_id', '=', 'price_types.id')
            ->where('price_types.id', 'promotion_urls.price_type_id')
            ->orWhere('conclusion_id', '=', ConclusionType::PENDING)
            ->orWhere('conclusion_id', '=', ConclusionType::ACCEPTED)
            ->sum('price_types.price');

        return $totalBudget - ($UrlCustomPrices + $UrlTypePrices);
    }

    /**
     * Get the current website budget which is left.
     *
     * @param int $website_id
     * @return mixed
     */
    public static function getWebsiteBudget(int $website_id): mixed
    {
        $totalBudget = DB::table('budgets')
            ->join('websites', 'budgets.website_id', '=', 'websites.id')
            ->where('budgets.website_id', $website_id)
            ->where('budgets.date', '<=', now())
            ->sum('budgets.amount');

        $UrlCustomPrices = DB::table('promotion_urls')
            ->where('promotion_urls.conclusion_id', ConclusionType::ACCEPTED)
            ->where('website_id', $website_id)
            ->sum('custom_price');

        $UrlTypePrices = DB::table('promotion_urls')
            ->join('price_types', 'promotion_urls.price_type_id', '=', 'price_types.id')
            ->where('website_id', $website_id)
            ->where('price_types.id', 'promotion_urls.price_type_id')
            ->orWhere('conclusion_id', '=', ConclusionType::PENDING)
            ->orWhere('conclusion_id', '=', ConclusionType::ACCEPTED)
            ->sum('price_types.price');

        return $totalBudget - ($UrlCustomPrices + $UrlTypePrices);
    }

    /**
     * Get budget data by website id.
     *
     * @param int $website_id
     * @return LengthAwarePaginator
     */
    public static function getBudgetsByWebsiteId(int $website_id): LengthAwarePaginator
    {
        return DB::table('budgets')
            ->join('websites', 'budgets.website_id', '=', 'websites.id')
            ->where('budgets.website_id', $website_id)
            ->orderBy('budgets.date')
            ->select('budgets.id', 'budgets.amount', 'budgets.date')
            ->paginate(24);
    }

    /**
     * Get the most recent budget date by website id.
     *
     * @param int $website_id
     * @return stdClass
     */
    public static function getRecentBudgetByWebsiteId(int $website_id): stdClass
    {
        return DB::table('budgets')
            ->join('websites', 'budgets.website_id', '=', 'websites.id')
            ->where('budgets.website_id', $website_id)
            ->orderBy('budgets.date')
            ->select('budgets.date')
            ->first();
    }

    /**
     * Return if the budget date for a website already exists or not.
     *
     * @param int $website_id
     * @param $date
     * @return bool
     */
    public static function websiteBudgetDateExists(int $website_id, $date): bool
    {
        $existingDate =  DB::table('budgets')
            ->where('budgets.website_id', $website_id)
            ->where('budgets.date', $date)
            ->count();

        return $existingDate > 0;
    }
}
