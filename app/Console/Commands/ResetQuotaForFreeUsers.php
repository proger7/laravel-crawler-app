<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use DB;

class ResetQuotaForFreeUsers extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:quotas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command resets the quota to free users.';

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
        for ($i = 1; $i <= 500; $i++) {
            Redis::command("hset", ["RateLimits", "User:{$i}:limit", 100]);
        }
    }

}
