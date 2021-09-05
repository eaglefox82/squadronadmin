<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminat\Support\Facades\DB;
use Carbon\Carbon;
use App\Events;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\ScheduleCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       $schedule->call(function () {

            // Get todays date
            $today = Carbon::today();

            // Get Outstanding Events
            $events = Events::where('finished','N')->pluck('event_date', 'id');

            foreach($events as $event_date=>$id) {
                if($today > Carbon::parse($event_date)->addMonths(2)) {
                   Events::find($id)->update(['finish'=>'Y']);
                }
            }
       })->daily();

        // $schedule->command('inspire')
        //          ->hourly();
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
