<?php

namespace App\Console;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Retrieve user-inputted time from the database
            $events = Event::get();

            $currentTime = Carbon::now();
            foreach ($events as $event) {
                // Parse end_session_scheduled_attendance as Carbon instance
                $endTime = Carbon::parse($event->end_session_scheduled_attendance);

                // Compare times
                if ($endTime->format('H:i') == $currentTime->format('H:i')) {
                    $event_id = Event::find($event->event_id);
                    $event_id->update([
                        'attendance_status' => 2,
                    ]);
                }
            }
            Log::info('Attendance status updated for event: ');
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
