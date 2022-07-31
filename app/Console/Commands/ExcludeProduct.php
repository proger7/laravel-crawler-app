<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ExcludeProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exclude:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exclude blocked product from DB';

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
        $url = "https://tnai.hosting4.tn-rechenzentrum1.de/tntools/send_blocked.php";
        $field = "get_blocked";
        $header = ['Accept: application/json'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
        $result = curl_exec($ch);
        $_result = str_replace('"', '', trim($result, '[]'));

        $query = DB::table("products")->whereIn('id', explode(",", $_result))->delete();

        if(!$query) {
            dd('Please enter correct id\'s');
        } else {
            echo 'DONE';
        }
        
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
