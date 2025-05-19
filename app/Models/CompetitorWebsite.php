<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CompetitorWebsite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'url',
    ];

    /**
     * Get the customer that the competitor website owns.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the website competitor check that the competitor website owns.
     *
     * @return HasMany
     */
    public function websiteCompetitorCheck(): HasMany
    {
        return $this->hasMany(WebsiteCompetitorCheck::class);
    }

    /**
     * Get competitors assigned to a specific customer.
     *
     * @param int $id
     * @return LengthAwarePaginator
     */
    public static function getCompetitorsByCustomerId(int $id): LengthAwarePaginator
    {
        return DB::table('competitor_websites')
            ->where('customer_id', $id)
            ->paginate(20);
    }

    /**
     * Get amount of customer users by website competitor.
     *
     * @return array
     */
    public static function getCompetitorWebsitesWithoutArchivedCustomer(): array
    {
        return DB::table('competitor_websites')
            ->join('companies', 'companies.id', '=', 'competitor_websites.customer_id')
            ->join('users', 'users.company_id', '=', 'companies.id')
            ->where('companies.archived', false)
            ->where('users.status_id', Status::ENABLED)
            ->where('users.role_id', Role::CUSTOMER)
            ->select('competitor_websites.url')
            ->groupBy('competitor_websites.url')
            ->get()
            ->toArray();
    }
}
