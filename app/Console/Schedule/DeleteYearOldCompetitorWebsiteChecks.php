<?php

namespace App\Console\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DeleteYearOldCompetitorWebsiteChecks
{
    /**
     * All competitor website checks older than a year are deleted automatically.
     *
     * @return void
     */
    public function __invoke()
    {
        DB::table('website_competitor_checks')
            ->where('datetime', '<=', Carbon::now()->subYear())
            ->delete();
    }
}
