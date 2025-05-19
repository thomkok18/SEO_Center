<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WebsiteCompetitorCheck extends Model
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
     * Get the competitor website that the competitor website owns.
     *
     * @return BelongsTo
     */
    public function competitorWebsite(): BelongsTo
    {
        return $this->belongsTo(CompetitorWebsite::class);
    }

    /**
     * Get all checks of a specific customer website.
     *
     * @param int $id
     * @return Collection
     */
    public static function getWebsiteCheckHistoryByWebsite(int $id): Collection
    {
        return DB::table('website_competitor_checks')
            ->where('website_id', '=', $id)
            ->get();
    }
}
