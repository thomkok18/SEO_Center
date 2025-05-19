<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class PromotionUrlCheck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promotion_url_id',
        'check_id',
    ];

    /**
     * Get the promotion url that the promotion url check owns.
     *
     * @return BelongsTo
     */
    public function promotionUrl(): BelongsTo
    {
        return $this->belongsTo(PromotionUrl::class);
    }

    /**
     * Get the check that the promotion url check owns.
     *
     * @return BelongsTo
     */
    public function check(): BelongsTo
    {
        return $this->belongsTo(Check::class);
    }

    /**
     * Get the dates of every check of a promotion url.
     *
     * @param int $id
     * @return string|null
     */
    public static function getCheckedDates(int $id): string|null
    {
        return DB::table('promotion_url_checks')
            ->join('promotion_urls', 'promotion_url_checks.promotion_url_id', '=', 'promotion_urls.id')
            ->join('checks', 'promotion_url_checks.check_id', '=', 'checks.id')
            ->select('checks.measured_at')
            ->where('promotion_urls.id', '=', $id)
            ->max('checks.measured_at');
    }

    /**
     * Get most recent check data by promotionUrl.
     *
     * @param int $id
     * @return object|array
     */
    public static function getCheckByPromotionUrl(int $id): object|array
    {
        $checks = DB::table('promotion_url_checks')
            ->join('promotion_urls', 'promotion_url_checks.promotion_url_id', '=', 'promotion_urls.id')
            ->join('checks', 'promotion_url_checks.check_id', '=', 'checks.id')
            ->join('majestic_checks', 'checks.majestic_check_id', '=', 'majestic_checks.id')
            ->join('moz_checks', 'checks.moz_check_id', '=', 'moz_checks.id')
            ->join('users', 'checks.user_id', '=', 'users.id')
            ->select('promotion_urls.id as promotion_url_id', 'checks.user_id', 'users.firstname', 'users.inserts', 'users.lastname', 'checks.measured_at', 'checks.latest_scan', 'checks.latest_scan_update', 'moz_checks.domain_authority', 'majestic_checks.citation_flow', 'majestic_checks.trust_flow', 'checks.commentary')
            ->where('promotion_urls.id', '=', $id)
            ->orderByDesc('checks.measured_at')
            ->get()
            ->toArray();

        if (count($checks) > 0) {
            return $checks[0];
        }

        return (object) [
            'promotion_url_id' => $id,
            'user_id' => null,
            'measured_at' => null,
            'latest_scan' => null,
            'latest_scan_update' => null,
            'domain_authority' => null,
            'citation_flow' => null,
            'trust_flow' => null,
            'commentary' => null
        ];
    }
}
