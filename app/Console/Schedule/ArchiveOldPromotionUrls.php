<?php

namespace App\Console\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArchiveOldPromotionUrls
{
    /**
     * All promotion urls older than a year are archived automatically.
     *
     * @return void
     */
    public function __invoke()
    {
        DB::table('promotion_urls')
            ->where('archived', '=', false)
            ->where('created_at', '<=', Carbon::now()->subYear())
            ->update(['archived' => true]);
    }
}
