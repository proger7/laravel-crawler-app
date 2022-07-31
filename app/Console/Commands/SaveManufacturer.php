<?php

namespace App\Console\Commands;

use App\Models\Manufacturer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class SaveManufacturer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hersteller:save {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'hersteller:save {--url= : Основной адрес сайта, который нужно спарсить}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function runCommand()
    {
        $url = $this->option('url') ?? dd('Please enter url of site');
        $manufacturers = Manufacturer::getInstance()->getManufacturers($url);
        Manufacturer::getInstance()->saveManufacturers($manufacturers);
        echo 'DONE';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(Config::get('settings.Confirmation_request_for_terminal_run') == 1) {
            if ($this->confirm('Do you wish to continue? [yes|no]')) {
                $this->runCommand();
            }
        } elseif(Config::get('settings.Confirmation_request_for_terminal_run') == 0) {
            $this->runCommand();
        }
    }
}
