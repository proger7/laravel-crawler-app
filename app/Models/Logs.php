<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Logs extends Model
{

    use Sortable;
    use Cachable;

    protected $table = 'logs';

    protected $fillable = [
    	'v_status',
    	'n_parsed_qua',
    	'v_url',
    	'v_site_url',
    	'v_content_type',
    	'v_comment',
    	'v_command'
    ];

    public $sortable = ['v_status', 'n_parsed_qua', 'v_url', 'v_comment', 'v_command'];
  
    public function scopeElements($query, array $element)
    {
        return $query->whereIn('id', $element);
    }

}
