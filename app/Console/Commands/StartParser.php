<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Parser;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use DB;

class StartParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:start {from?}{count?}{--url=}{--cattype=}{--mode=parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='parser:start
                        {from : С какого элемента начать парсить}
                        {count : Сколько элементов спарсить}
                        {--url= : Какую категорию нужно спарсить}
                        {--cattype= : Какой тип категории нужно парсить}
                        {--mode= : Какой режим работы: parse или compare}';
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
        $from = $this->argument('from') ?? Config::get('settings.count_product_from');
        $count = $this->argument('count') ?? Config::get('settings.count_product_count');
        $cat = $this->option('url') ?? dd('Please enter url of category');
        $cattype = $this->option('cattype') ?? dd('Please enter type of category');

        $command = "sudo php artisan " . $this->argument('command');
        if($this->argument('from')) $command .= " " . $this->argument('from');
        if($this->argument('from') == 0) $command .= " " . 0;
        if($this->argument('count')) $command .= " " . $this->argument('count');
        if($this->argument('count') == 0) $command .= " " . 0;
        if($this->option('url')) $command .= " --url=" . $this->option('url'); 
        if($this->option('cattype')) $command .= " --cattype=" . $this->option('cattype');
        
        $r_command = $command;
        $site_url = $this->option('url');
        $product_list = Product::getInstance()->getProductUrl($from, $count, $cat);



        if($this->option('mode') == 'parse') {
            Product::getInstance()->saveProducts($product_list, $cattype, $r_command, $site_url);
        } elseif($this->option('mode') == 'compare') {
            Product::getInstance()->saveProductsForCompare($product_list, $cattype, $site_url);
        } else {
            dd('Please enter mode: parse or compare mode');
        }

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
