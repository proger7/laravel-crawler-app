<?php

namespace App\Console\Commands;

use App\Models\Manufacturer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class SaveHerstellerSubcategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subcategory:save {--subcat=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='subcategory:save
                        {--subcat= : Какую подкатегорию спарсить}';

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
        $subcat = $this->option('subcat') ?? dd('Please enter url of subcategory');
        $subcategory_list = Manufacturer::getInstance()->getSubcategories($subcat);

        Manufacturer::getInstance()->saveManufacturers($subcategory_list);
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
