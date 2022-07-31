<?php

namespace App\Models;

use DB;
use App\Models\Configurations;
use App\Models\Logs;
use App\Models\Category;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Services\LogService;

class Category extends Parser
{

    use Cachable;

    protected $table = 'categories';

    protected $fillable = [
        'category_type',
        'v_site_url',
        'name',
        'alias',
        'link',
    ];


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
     * @return array $categories
     */
    public function getCategories($url)
    {

        $page = $this->getCrawler($url);

        $parseURL = parse_url($url);
        $baseURL = $parseURL['scheme'] . '://' . $parseURL['host'];

        $filter = Configurations::filter('20_get_Categories_List', $baseURL);
        $v12 = $filter->value('v_content_type');

        $categories = [];
        $page = $page->filter($v12);

        foreach ($page as $item) {
            $categories[] = [
                'category_type' => 'product_category',
                'v_site_url' => $baseURL,
                'name' => $item->textContent,
                'alias' => trim($item->getAttribute('href'), '/'),
                'link' => $item->getAttribute('href'),
            ];

        }

        $count_categories = count($categories);
        LogService::getCategoryLog($filter, $count_categories, $url, $baseURL, $v12);

        if (!$v12 || $v12 === null) {
            throw new \Exception('There is no suitable filter!');
        }

        return $categories;
    }

    
    /**
     * @param  array $categories
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function saveCategories($categories){
        foreach ($categories as $category)
            $this::updateOrCreate($category);
    }


}