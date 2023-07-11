<?php

namespace App\Console;

use App\Mail\TaskReminder;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $tasks = Task::where('due_date', Carbon::now()->addDay())->get();

        foreach ($tasks as $task) {
            Mail::to($task->user->email)->send(new TaskReminder($task));
        }
    })->daily();
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
