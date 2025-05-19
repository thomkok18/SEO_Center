<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Check extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'web_crawler_check_id',
        'moz_check_id',
        'majestic_check_id',
        'commentary',
        'measured_at',
        'latest_scan',
        'latest_scan_update',
    ];

    /**
     * Get the promotion url check that the check owns.
     *
     * @return HasMany
     */
    public function promotionUrlCheck(): HasMany
    {
        return $this->hasMany(PromotionUrlCheck::class);
    }

    /**
     * Get the majestic checks that the check owns.
     *
     * @return BelongsTo
     */
    public function majesticCheck(): BelongsTo
    {
        return $this->belongsTo(MajesticCheck::class);
    }

    /**
     * Get the majestic checks that the check owns.
     *
     * @return BelongsTo
     */
    public function mozCheck(): BelongsTo
    {
        return $this->belongsTo(MozCheck::class);
    }

    /**
     * Get the web crawler checks that the check owns.
     *
     * @return BelongsTo
     */
    public function webCrawlerCheck(): BelongsTo
    {
        return $this->belongsTo(WebCrawlerCheck::class);
    }

    /**
     * Get most recent accepted promotion url datetime.
     *
     * @param int $id
     * @return string
     */
    public static function getRecentAcceptedPromotionUrl(int $id): string
    {
        return DB::table('checks')
            ->join('promotion_url_checks', 'checks.id', '=', 'promotion_url_checks.check_id')
            ->join('promotion_urls', 'promotion_url_checks.promotion_url_id', '=', 'promotion_urls.id')
            ->where('promotion_urls.website_id', '=', $id)
            ->where('promotion_urls.conclusion_id', '=', ConclusionType::ACCEPTED)
            ->max('checks.measured_at');
    }
}
