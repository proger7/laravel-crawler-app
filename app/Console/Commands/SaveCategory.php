<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class SaveCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:save {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='category:save {--url= : Основной адрес сайта, который нужно спарсить}';

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
     * run artisan command
     * 
     * @return array $categories
     */
    public function runCommand()
    {
        $url = $this->option('url') ?? dd('Please enter base url of site');
        $categories = Category::getInstance()->getCategories($url);
        //Сохраняем их в бд
        Category::getInstance()->saveCategories($categories);
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
