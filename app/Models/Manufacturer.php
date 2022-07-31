<?php

namespace App\Models;

use App\Models\Configurations;
use App\Models\Logs;
use DB;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Services\LogService;

class Manufacturer extends Parser
{

    use Cachable;

    protected $table = 'manufacturers';

    protected $fillable = [
        'category_type',
        'v_site_url',
        'name',
        'alias',
        'link',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    /**
     * @param  string $url
     * @return boolean
     */
    public function isAbsoluteUrl($url)
    {
        $pattern = "/^(?:ftp|https?|feed)?:?\/\/(?:(?:(?:[\w\.\-\+!$&'\(\)*\+,;=]|%[0-9a-f]{2})+:)*
        (?:[\w\.\-\+%!$&'\(\)*\+,;=]|%[0-9a-f]{2})+@)?(?:
        (?:[a-z0-9\-\.]|%[0-9a-f]{2})+|(?:\[(?:[0-9a-f]{0,4}:)*(?:[0-9a-f]{0,4})\]))(?::[0-9]+)?(?:[\/|\?]
        (?:[\w#!:\.\?\+\|=&@$'~*,;\/\(\)\[\]\-]|%[0-9a-f]{2})*)?$/xi";

        return (bool) preg_match($pattern, $url);
    }


    /**
     * @param  array $params
     * @return array $instance
     */
    public static function getInstance($params = [])
    {
        $instance = new static();
        if ($params) {
            foreach ($params as $attr => $value) {
                $instance->$attr = $value;
            }
        }

        return $instance;
    }


    /**
     * @param  string $url
     * @return array $subcategories
     */
    public function getSubcategories($url)
    {
        $page = $this->getCrawler($url);


        $parseURL = parse_url($url);
        $baseURL = $parseURL['scheme'] . '://' . $parseURL['host'];

        $filter = Configurations::filter('30_get_Subcategories_Hersteller_title', $baseURL);
        $v13 = $filter->value('v_content_type');

        $subcategories = [];
        $page = $page->filter($v13);

        foreach ($page as $item) {
            $subcategories[] = [
                'category_type' => 'hersteller_category_carousel',
                'v_site_url' => $url,
                'name' => $item->textContent,
                'alias' => trim($item->getAttribute('href'), '/'),
                'link' => $this->isAbsoluteUrl($item->getAttribute('href')) ? $item->getAttribute('href') : $baseURL . '/' . $item->getAttribute('href')
            ];
        }

        $count_subcategories = count($subcategories);
        LogService::getManufacturerSubcategoriesLog($filter, $count_subcategories, $url, $v13);

        if (!$v13 || $v13 === null) {
            throw new \Exception('There is no suitable filter!');
        }

        return $subcategories;   

    }


    /**
     * @param  string $url
     * @return array $manufacturers
     */
    public function getManufacturers($url)
    {
        $page = $this->getCrawler($url);


        $parseURL = parse_url($url);
        $baseURL = $parseURL['scheme'] . '://' . $parseURL['host'];

        $filter = Configurations::filter('40_get_Manufacturers_Hersteller_list', $baseURL);
        $v14 = $filter->value('v_content_type');

        $manufacturers = [];
        $page = $page->filter($v14);


        foreach ($page as $item) {
            $manufacturers[] = [
                'category_type' => 'hersteller_category',
                'v_site_url' => $url,
                'name' => $item->textContent,
                'alias' => trim($item->getAttribute('href'), '/'),
                'link' => $item->getAttribute('href'),
            ];
        }
        
        $count_manufacturers = count($manufacturers);
        LogService::getManufacturerLog($filter, $count_manufacturers, $url, $v14);

        if (!$v14 || $v14 === null) {
            throw new \Exception('There is no suitable filter!');
        }
        

        return $manufacturers;

    }

    /**
     * @param  array $manufacturers
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function saveManufacturers($manufacturers){
        foreach ($manufacturers as $manufacturer)
            $this::updateOrCreate($manufacturer);
    }
}
