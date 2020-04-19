<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\User;
use App\Notifications\EndDayNotification;
use Illuminate\Support\Facades\Log;
class EndDayNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:endday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will fire end day notification @ 3 PM everyday';

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
            $user = User::find($user->id)->notify(new EndDayNotification());
        }
        Log::info('End Day Notify Executed at: '.Carbon::now());
    }
}
