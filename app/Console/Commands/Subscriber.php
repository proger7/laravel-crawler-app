<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Subscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscriber';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the listener';

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
        Redis::subscribe([ 'channel_name' ], function ($message) {
            $this->processMessage($message);
        });
    }

    /**
     * Handles the received message
     * @param  string $message
     * @return string
     */
    public function processMessage(string $message)
    {
        $this->info(sprintf('Message received: %s', $message));
    }
}
