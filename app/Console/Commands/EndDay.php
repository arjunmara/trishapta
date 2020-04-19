<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\SiteConfig;
use Illuminate\Support\Facades\Log;
class EndDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:endday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will set end day to 0 at midnight';

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
        $EndDay = SiteConfig::where('key', 'end_day')->update(['value' => 0]);
        Log::info('End Day Executed at: '.Carbon::now());
    }
}
