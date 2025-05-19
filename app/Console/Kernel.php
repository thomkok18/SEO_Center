<?php

namespace App\Console;

use App\Console\Schedule\ArchiveOldPromotionUrls;
use App\Console\Schedule\CheckAnchorTagsOnWebsites;
use App\Console\Schedule\DeleteYearOldCompetitorWebsiteChecks;
use App\Console\Schedule\IndexCustomerAndCompetitorWebsite;
use App\Console\Schedule\GetIndexedCustomerAndCompetitorWebsiteScores;
use App\Console\Schedule\UpdateWordpressBlogDataInSEOCenter;
use App\Console\Schedule\DeleteDayOldCSV;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(new DeleteDayOldCSV)->daily();
        $schedule->call(new IndexCustomerAndCompetitorWebsite)->monthlyOn(24, '00:00');
        $schedule->call(new GetIndexedCustomerAndCompetitorWebsiteScores)->monthlyOn(25, '00:00');
        $schedule->call(new ArchiveOldPromotionUrls)->daily();
        $schedule->call(new DeleteYearOldCompetitorWebsiteChecks)->daily();
        $schedule->call(new UpdateWordpressBlogDataInSEOCenter)->daily();
        $schedule->call(new CheckAnchorTagsOnWebsites)->monthlyOn(1, '00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
