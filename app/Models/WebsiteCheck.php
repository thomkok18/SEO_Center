<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WebsiteCheck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'domain_authority',
        'citation_flow',
        'trust_flow',
        'datetime',
    ];

    /**
     * Get the website that the website check owns.
     *
     * @return BelongsTo
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * Get all checks of a specific customer website.
     *
     * @param int $id
     * @return Collection
     */
    public static function getWebsiteCheckHistoryByWebsite(int $id): Collection
    {
        return DB::table('website_checks')
            ->where('website_id', '=', $id)
            ->get();
    }

    /**
     * Get all checks of all customer websites.
     *
     * @param int $id
     * @return Collection
     */
    public static function getWebsiteCheckHistoryByCompany(int $id): Collection
    {
        return DB::table('website_checks')
            ->join('websites', 'website_checks.website_id', '=', 'websites.id')
            ->where('websites.company_id', '=', $id)
            ->get();
    }
}
