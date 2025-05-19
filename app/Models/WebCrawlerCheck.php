<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebCrawlerCheck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain_name',
        'server_ip',
        'http_status',
        'page_language',
        'page_title',
        'page_description',
        'measured_at',
        'follow_internal_links',
        'no_follow_internal_links',
        'follow_external_links',
        'no_follow_external_links',
        'follow_social_links',
        'no_follow_social_links',
        'follow_customer_links',
        'no_follow_customer_links',
        'follow_competitor_links',
        'no_follow_competitor_links',
        'image_count',
    ];

    /**
     * Get the check check that the web crawler check owns.
     *
     * @return HasMany
     */
    public function check(): HasMany
    {
        return $this->hasMany(Check::class);
    }
}
