<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use UploadImage;
use App\Models\Configurations;
use App\Models\Logs;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DB;
use GuzzleHttp;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;


class Store extends Model
{

    use Cachable;

    protected $table = 'stores';


    protected $fillable = [
        'v_url',
        'v_code'
    ];

    public function scopeFilterUrl($query, $url)
    {
    	return $query->where('v_url', $url);
    }

    public function scopeFilterCode($query, $code)
    {
    	return $query->where('v_code', $code);
    }

}
