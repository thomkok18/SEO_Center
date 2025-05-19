<?php

namespace App\Console\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DeleteDayOldCSV
{
    /**
     * Delete csv files from database older than a day.
     *
     * @return void
     */
    public function __invoke()
    {
        DB::table('import_data')->where('updated_at', '<=', Carbon::now()->subDay())->delete();
    }
}
