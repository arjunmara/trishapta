<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\User;
use App\Notifications\TodayTaskNotification;
use Illuminate\Support\Facades\Log;
class TodayTaskNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will fire today task notification @ 9 AM everyday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user = User::find($user->id)->notify(new TodayTaskNotification());
        }
        Log::info('Task Executed at: '.Carbon::now());
    }
}
