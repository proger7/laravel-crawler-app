<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use UploadImage;
use DB;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use GuzzleHttp;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Configurations extends Model
{

	use Sortable;
    use Cachable;

    protected $table = 'configurations';

    protected $fillable = [
    	'v_url',
    	'v_site_url',
    	'v_content_type',
    	'v_filter_type',
    	'v_function'
    ];

    public $sortable = ['v_site_url', 'v_content_type', 'v_function'];
    

    public function scopeFilter($filter, $search, $search2 = null)
    {
        if ($search2 !== null) {
            return $filter->where(function($query) use ($search, $search2) {
                $query->where('v_function', '=', $search)
                      ->where('v_site_url', '=', $search2);
            });
        }

        return $filter->where('v_function', '=', $search);
    }

    public function scopeItem($query, $search)
    {
        return $query->where('id', $search);
    }

    public function scopeElements($query, array $element)
    {
        return $query->whereIn('id', $element);
    }

}
