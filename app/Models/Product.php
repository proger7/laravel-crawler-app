<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use UploadImage;
use App\Models\Configurations;
use App\Models\Logs;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DB;
use GuzzleHttp;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Services\LogService;


class Product extends Parser
{

    use Cachable;

    protected $table = 'products';


    protected $fillable = [
        'store_id',
        'store_code',
        'site_url',
        'name',
        'category_alias',
        'category_type',
        'category_url',
        'category_name',
        'price',
        'v_image_name_local',
        'v_image_path_local',
        'main_image_url',
        'image_size',
        'images_urls',
        'text_description',
        'is_promotional',
        'is_new',
        'old_price',
        'new_price',
        'product_configure',
        'product_content',
        'url',
        'v_command'
    ];


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
     * @param  string $from
     * @param  string $to
     * @param  string $cat
     * @return array $product_urls
     */
    public function getProductUrl($from, $to, $cat)
    {

        $config_category_list = $cat; 
         

        if(is_string($config_category_list) && strlen($config_category_list) > 0) 
        {
            $product_urls = array();
            $product_urls = $this->getProductList($config_category_list);
            $product_urls = array_slice($product_urls, $from, $to);

            return $product_urls;
        }       

    }

    /**
     * @param  string $url
     * @return array $product_links
     */
    public function getProductList($url)
    {

        $page = $this->getCrawler($url);

        global $test;
        $test = $url;


        $parseURL = parse_url($url);
        $baseURL = $parseURL['scheme'] . '://' . $parseURL['host'];

        $filterPagination = Configurations::filter('01_get_ProductList_pagination', $baseURL);
        $filterProductListTitleInCategory = Configurations::filter('11_get_ProductList_Title_In_Category', $baseURL);
        $filterProductPaginationElement = Configurations::filter('14_get_ProductList_Pagination_Elements', $baseURL);
        $filterNextPaginationElement = Configurations::filter('15_filter_Nechste', $baseURL);
        $filterMaximumPages = Configurations::filter('16_filter_Max_Pages', $baseURL);


        $v1 = $filterPagination->value('v_content_type');
        $v11 = $filterProductListTitleInCategory->value('v_content_type');
        $v14 = $filterProductPaginationElement->value('v_content_type');
        $v15 = $filterNextPaginationElement->value('v_content_type');
        $v16 = $filterMaximumPages->value('v_content_type');



        if($page->filter($v1)) {
            if($page->filter($v14)->count() > 0 || $page->filter($v15)->count() > 0) {
                $countPaginateElements = $page->filter($v14)->count();
                $paginationRate = $page->filter($v15)->count() == 0 ? 1 : 2;
                $countPaginateElementsUnique = ($countPaginateElements - $paginationRate);

                $maxPaginateElement = trim($page->filter($v14)->eq($countPaginateElementsUnique)->text());
            
            } elseif ($page->filter($v16)->count() > 0) {
                $maxPaginateElement = trim($page->filter($v16)->text());
            } else {
                $maxPaginateElement = 1;
            }

        }



        if($page->filter($v1)->count() > 0) 
        {

            $page = $page->filter($v1)->last();

            $result = stripos($page->attr('href'), $baseURL);
            $baseURL = ($result === 0) ? "" : $baseURL;  
            $lastlink = $baseURL . $page->attr('href'); 

            $x = preg_match_all('!\d+!', $lastlink, $matches);
            $c = count($matches[0]) - 1;
            $num = $matches[0][$c]; 

            $symbol = '***';
            $count_str = strlen($lastlink);
            $count_num = strlen($num);
            $count = $count_str - $count_num;
            $replace_str = substr_replace($lastlink, $symbol, $count); 


            $lastlink = str_replace($symbol, $maxPaginateElement, $replace_str);
            $links_page_paginate = $this->getPageLinks($maxPaginateElement, $lastlink);


            $product_links = $this->getLinks($url, $v11);



            foreach ($links_page_paginate as $item) {
                $product_links += $this->getLinks($item, $v11);
            }


            return $product_links; 

        } elseif($page->filter($v1)->count() == 0) {

            $links_page_paginate = $this->getPageLinks(0, 0);
            $product_links = $this->getLinks($url, $v11);


            foreach ($links_page_paginate as $item) {
                $product_links += $this->getLinks($item, $v11);
            }


            return $product_links;  
        } 

    }

    /**
     * @param  string $glue
     * @param  array $arr
     * @return string
     */
    public function implode_all($glue, $arr)
    {  

        for ($i=0; $i<count($arr); $i++) {
            if (@is_array($arr[$i])) 
                $arr[$i] = implode_all($glue, $arr[$i]);
        }  

        return implode($glue, $arr);

    }

    /**
     * @param string $url
     */
    public function Check_URL_make_it_absolute_if_necessary($url)
    {

        $parseURL = parse_url($url);

        if(!empty($parseURL['scheme']) && !empty($parseURL['host'])) {
            $baseURL = $parseURL['scheme'] . '://' . $parseURL['host'];
        } else {
            $parseTest = parse_url($GLOBALS['test']);
            $baseURL = $parseTest['scheme'] . '://' . $parseTest['host'];
        }

        return $baseURL;

    }

    /**
     * @param  string $url
     * @param  string $number
     * @param  string $r_command
     * @return array 
     */
    public function saveLogs($url, $number, $r_command)
    {

        $baseURL = $this->Check_URL_make_it_absolute_if_necessary($url);

        $filterProductName = Configurations::filter('02_get_ProductInfo_Product_Name', $baseURL);
        $filterCategoryURL = Configurations::filter('03_get_ProductInfo_Category_URL', $baseURL);
        $filterCategoryName = Configurations::filter('04_get_ProductInfo_Category_Name', $baseURL);
        $filterProductPrice = Configurations::filter('05_get_ProductInfo_Price', $baseURL);
        $filterMainImageURL = Configurations::filter('06_get_ProductInfo_MainImage_URL', $baseURL);
        $filterProductDescription = Configurations::filter('07_get_ProductInfo_Description', $baseURL);
        $filterProductPromotional = Configurations::filter('08_get_ProductInfo_Promotional', $baseURL);
        $filterOldPrice = Configurations::filter('09_get_ProductInfo_Old_Price', $baseURL);
        $filterNewPrice = Configurations::filter('10_get_ProductInfo_New_Price', $baseURL);
        
        LogService::saveLogToDatabase(
            $filterProductName, 
            $filterCategoryURL, 
            $filterCategoryName, 
            $filterProductPrice, 
            $filterMainImageURL, 
            $filterProductDescription, 
            $filterProductPromotional, 
            $filterOldPrice, 
            $filterNewPrice,
            $number,
            $baseURL,
            $r_command
        );     
    }

    /**
     * @param  string $url
     * @param  string $category
     * @param  string $cattype
     * @param  string $site_url
     * @param  string $r_command
     * @return array $product
     */
    public function getProductInfo($url, $category, $cattype, $site_url, $r_command)
    {

        $baseURL = $this->Check_URL_make_it_absolute_if_necessary($url);

        $result_url = stripos($url, $baseURL);

        if($result_url === 0) {
            $page = $this->getCrawler($url);
        } elseif($result_url === false) {
            $page = $this->getCrawler($baseURL . '/' . $url);  
        }

        $filterProductName = Configurations::filter('02_get_ProductInfo_Product_Name', $baseURL);
        $filterCategoryURL = Configurations::filter('03_get_ProductInfo_Category_URL', $baseURL);
        $filterCategoryName = Configurations::filter('04_get_ProductInfo_Category_Name', $baseURL);
        $filterProductPrice = Configurations::filter('05_get_ProductInfo_Price', $baseURL);
        $filterMainImageURL = Configurations::filter('06_get_ProductInfo_MainImage_URL', $baseURL);
        $filterProductDescription = Configurations::filter('07_get_ProductInfo_Description', $baseURL);
        $filterProductPromotional = Configurations::filter('08_get_ProductInfo_Promotional', $baseURL);
        $filterOldPrice = Configurations::filter('09_get_ProductInfo_Old_Price', $baseURL);
        $filterNewPrice = Configurations::filter('10_get_ProductInfo_New_Price', $baseURL);
        $filterConfigure = Configurations::filter('12_get_ProductInfo_Configure', $baseURL);
        $filterContent = Configurations::filter('13_get_ProductInfo_Content', $baseURL);


        $v02 = $filterProductName->value('v_content_type') ?? '';
        $v03 = $filterCategoryURL->value('v_content_type') ?? '';
        $v04 = $filterCategoryName->value('v_content_type') ?? '';
        $v05 = $filterProductPrice->value('v_content_type') ?? '';
        $v06 = $filterMainImageURL->value('v_content_type') ?? '';
        $v07 = $filterProductDescription->value('v_content_type') ?? '';
        $v08 = $filterProductPromotional->value('v_content_type') ?? '';
        $v09 = $filterOldPrice->value('v_content_type') ?? '';
        $v10 = $filterNewPrice->value('v_content_type') ?? '';
        $v12 = $filterConfigure->value('v_content_type') ?? '';
        $v13 = $filterContent->value('v_content_type') ?? '';


        $store_id = Store::filterUrl($baseURL)->value('id');
        $store_code = Store::filterUrl($baseURL)->value('v_code');

        $product['store_id'] = $store_id;
        $product['store_code'] = $store_code;
        $product['site_url'] = $site_url;
        $product['category_type'] = $cattype;


        if($page->filter($v02)->count() > 0) {
            $product['name'] = $product['name'] ?? trim($page->filter($v02)->eq(0)->text());
        } elseif($page->filter($v02)->count() == 0) {
            $product['name'] = '';
        }
      

        if(is_string($url) && strlen($url) > 0) {
            $product['category_alias'] = $url ?? '';
        } elseif(strlen($url) == 0) {
            $product['category_alias'] = '';
        }


        if($page->filter($v03)->count() > 0) {
            $product['category_url'] = $product['category_url'] ?? $page->filter($v03)->attr('href');
        } elseif($page->filter($v03)->count() == 0) {
            $product['category_url'] = '';
        }


        if($page->filter($v04)->count() > 0) {
            $product['category_name'] = $product['category_name'] ?? trim($page->filter($v04)->text());
        } elseif($page->filter($v04)->count() == 0) {
            $product['category_name'] = '';
        }



        if($page->filter($v05)->count() > 0) {
            $product['price'] = $product['price'] ?? trim($page->filter($v05)->eq(0)->text());
        } elseif($page->filter($v05)->count() == 0) {
            $product['price'] = '';
        } 


        $imageFilter = $page->filter($v06);  


        if($imageFilter->count() > 0) {

            $imageFilterAttributeSrc = $imageFilter->eq(0)->attr('src'); 
            $imageFilterAttributeSrcset = $imageFilter->eq(0)->attr('srcset');

            $result_src = stripos($imageFilterAttributeSrc, $baseURL);
            $result_srcset = stripos($imageFilterAttributeSrcset, $baseURL);


            $isAbsoluteUrl_src = $this->isAbsoluteUrl($imageFilterAttributeSrc);
            $isAbsoluteUrl_srcset = $this->isAbsoluteUrl($imageFilterAttributeSrcset);


            if($imageFilterAttributeSrc && $isAbsoluteUrl_src == true) {
                $product['main_image_url'] = $imageFilterAttributeSrc;
            } elseif($imageFilterAttributeSrcset && $isAbsoluteUrl_srcset == true) {
                $product['main_image_url'] = $imageFilterAttributeSrcset;
            } elseif($imageFilterAttributeSrc && $isAbsoluteUrl_src == false) {
                $product['main_image_url'] = $baseURL . '/' . $imageFilterAttributeSrc;
            } elseif($imageFilterAttributeSrcset && $isAbsoluteUrl_srcset == false) {
                $product['main_image_url'] = $baseURL . '/' . $imageFilterAttributeSrcset;
            }


        } elseif($imageFilter->count() == 0) {  
            $product['main_image_url'] = 'no image';
        }



        $aSize = @getimagesize($product['main_image_url']);
        if($aSize) {
            list($width, $height) = $aSize;
            $product['image_size'] = $width . 'X' . $height;
        } else {
            $product['image_size'] = 'unknown size';
        }
 

        if($result_url === 0) {
            $parseHost = parse_url($baseURL);
            $public_path = "public/images/" . $parseHost['host'] . "/";
        } elseif($result_url === false) {
            $parseHost = parse_url($baseURL);
            $public_path = "public/images/" . $parseHost['host'] . "/";
        }


        if(!file_exists($public_path)) {
            mkdir($public_path, 0777, true);
        }


        if(strlen($product['main_image_url']) > 0) {

            $path = $public_path . $product['image_size'] . "/";

            if(!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $img_path = $path . basename($product['main_image_url']);     

            $file = @file_get_contents($product['main_image_url']);
            if($file !== false) {
                $insert = @file_put_contents($img_path, $file);
            } else {
                $product['main_image_url'] = 'public/images/default/No_image_available.png';
                $file = @file_get_contents($product['main_image_url']);
                $insert = @file_put_contents($img_path, $file);
            }

        } else {
            dd('No such image filter');
        }


        $imageName = strtok(basename($product['main_image_url']), '?');
        $product['v_image_name_local'] = !empty(basename($product['main_image_url'])) ? $imageName : '';
        $product['v_image_path_local'] = !empty($public_path) ? $public_path : '';


        if($page->filter($v07)->count() > 0) {
            $product['text_description'] = $product['text_description'] ?? trim($page->filter($v07)->text());
        } elseif($page->filter($v07)->count() == 0) {
            $product['text_description'] = '';
        }



        if($page->filter($v08)->count() > 0) {
            $product['is_promotional'] = $page->filter($v08)->count() ? 1 : 0;
        } elseif($page->filter($v08)->count() == 0) {
            $product['is_promotional'] = 0;
        }


        if($page->filter($v09)->count() > 0) {
            $product['old_price'] = $page->filter($v09)->count() ? trim($page->filter($v09)->eq(0)->text()) : null; 
        } elseif($page->filter($v09)->count() == 0) {
            $product['old_price'] = null;
        }

        
        if($page->filter($v10)->count() > 0) {
            $product['new_price'] = $page->filter($v10)->count() ? trim($page->filter($v10)->eq(0)->text()) : null;
        } elseif($page->filter($v10)->count() == 0) {
            $product['new_price'] = '';
        }


        if($page->filter($v12)->count() > 0) {
            $product['product_configure'] = $page->filter($v12)->count() ? trim($page->filter($v12)->html()) : null;
        } elseif($page->filter($v12)->count() == 0) {
            $product['product_configure'] = '';
        }



        if($page->filter($v13)->count() > 0) {
            $product['product_content'] = $page->filter($v13)->count() ? strip_tags(str_replace("\n", ' ', trim($page->filter($v13)->eq(0)->text()))) : null;
        } elseif($page->filter($v13)->count() == 0) {
            $product['product_content'] = '';
        }



        if(is_string($url) && strlen($url) > 0) {
            $product['url'] = $url;
        } elseif(strlen($url) == 0) {
            $product['url'] = '';
        }

        if(is_string($r_command) && strlen($r_command) > 0) {
            $product['v_command'] = $r_command;
        } elseif(strlen($r_command) == 0) {
            $product['v_command'] = '';
        }

        return $product;
        
    }

    /**
     * @param  string $url
     * @param  string $category
     * @param  string $cattype
     * @param  string $site_url
     * @return array $product
     */
    public function getProductInfoForCompare($url, $category, $cattype, $site_url)
    {

        $baseURL = $this->Check_URL_make_it_absolute_if_necessary($url);

        $result_url = stripos($url, $baseURL);

        if($result_url === 0) {
            $page = $this->getCrawler($url);
        } elseif($result_url === false) {
            $page = $this->getCrawler($baseURL . '/' . $url);  
        }

        $filterProductName = Configurations::filter('02_get_ProductInfo_Product_Name', $baseURL);
        $filterCategoryURL = Configurations::filter('03_get_ProductInfo_Category_URL', $baseURL);
        $filterCategoryName = Configurations::filter('04_get_ProductInfo_Category_Name', $baseURL);
        $filterProductPrice = Configurations::filter('05_get_ProductInfo_Price', $baseURL);
        $filterMainImageURL = Configurations::filter('06_get_ProductInfo_MainImage_URL', $baseURL);
        $filterProductDescription = Configurations::filter('07_get_ProductInfo_Description', $baseURL);
        $filterProductPromotional = Configurations::filter('08_get_ProductInfo_Promotional', $baseURL);
        $filterOldPrice = Configurations::filter('09_get_ProductInfo_Old_Price', $baseURL);
        $filterNewPrice = Configurations::filter('10_get_ProductInfo_New_Price', $baseURL);


        $v02 = $filterProductName->value('v_content_type') ?? '';
        $v03 = $filterCategoryURL->value('v_content_type') ?? '';
        $v04 = $filterCategoryName->value('v_content_type') ?? '';
        $v05 = $filterProductPrice->value('v_content_type') ?? '';
        $v06 = $filterMainImageURL->value('v_content_type') ?? '';
        $v07 = $filterProductDescription->value('v_content_type') ?? '';
        $v08 = $filterProductPromotional->value('v_content_type') ?? '';
        $v09 = $filterOldPrice->value('v_content_type') ?? '';
        $v10 = $filterNewPrice->value('v_content_type') ?? '';

        $store_id = Store::filterUrl($baseURL)->value('id');
        $store_code = Store::filterUrl($baseURL)->value('v_code');

        $product['store_id'] = $store_id;
        $product['store_code'] = $store_code;
        $product['site_url'] = $site_url;
        $product['category_type'] = $cattype;


        if($page->filter($v02)->count() > 0) {
            $product['name'] = $product['name'] ?? trim($page->filter($v02)->eq(0)->text());
        } elseif($page->filter($v02)->count() == 0) {
            $product['name'] = '';
        }


        if(is_string($url) && strlen($url) > 0) {
            $product['category_alias'] = $url ?? '';
        } elseif(strlen($url) == 0) {
            $product['category_alias'] = '';
        }

        if($page->filter($v03)->count() > 0) {
            $product['category_url'] = $product['category_url'] ?? $page->filter($v03)->attr('href');
        } elseif($page->filter($v03)->count() == 0) {
            $product['category_url'] = '';
        }

        if($page->filter($v04)->count() > 0) {
            $product['category_name'] = $product['category_name'] ?? trim($page->filter($v04)->text());
        } elseif($page->filter($v04)->count() == 0) {
            $product['category_name'] = '';
        }

        if($page->filter($v05)->count() > 0) {
            $product['price'] = $product['price'] ?? trim($page->filter($v05)->eq(0)->text());
        } elseif($page->filter($v05)->count() == 0) {
            $product['price'] = '';
        } 


        $imageFilter = $page->filter($v06);  


        if($imageFilter->count() > 0) {

            $imageFilterAttributeSrc = $imageFilter->eq(0)->attr('src'); 
            $imageFilterAttributeSrcset = $imageFilter->eq(0)->attr('srcset');

            $result_src = stripos($imageFilterAttributeSrc, $baseURL);
            $result_srcset = stripos($imageFilterAttributeSrcset, $baseURL);


            $isAbsoluteUrl_src = $this->isAbsoluteUrl($imageFilterAttributeSrc);
            $isAbsoluteUrl_srcset = $this->isAbsoluteUrl($imageFilterAttributeSrcset);


            if($imageFilterAttributeSrc && $isAbsoluteUrl_src == true) {
                $product['main_image_url'] = $imageFilterAttributeSrc;
            } elseif($imageFilterAttributeSrcset && $isAbsoluteUrl_srcset == true) {
                $product['main_image_url'] = $imageFilterAttributeSrcset;
            } elseif($imageFilterAttributeSrc && $isAbsoluteUrl_src == false) {
                $product['main_image_url'] = $baseURL . '/' . $imageFilterAttributeSrc;
            } elseif($imageFilterAttributeSrcset && $isAbsoluteUrl_srcset == false) {
                $product['main_image_url'] = $baseURL . '/' . $imageFilterAttributeSrcset;
            }


        } elseif($imageFilter->count() == 0) {  
            $product['main_image_url'] = 'no image';
        }


        $aSize = @getimagesize($product['main_image_url']);
        if($aSize) {
            list($width, $height) = $aSize;
            $product['image_size'] = $width . 'X' . $height;
        } else {
            $product['image_size'] = 'unknown size';
        }
 

        if($result_url === 0) {
            $parseHost = parse_url($baseURL);
            $public_path = "public/images/" . $parseHost['host'] . "/";
        } elseif($result_url === false) {
            $parseHost = parse_url($baseURL);
            $public_path = "public/images/" . $parseHost['host'] . "/";
        }


        if(!file_exists($public_path)) {
            mkdir($public_path, 0777, true);
        }


        if(strlen($product['main_image_url']) > 0) {

            $path = $public_path . $product['image_size'] . "/";

            if(!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $img_path = $path . basename($product['main_image_url']);     

            $file = @file_get_contents($product['main_image_url']);
            if($file !== false) {
                $insert = @file_put_contents($img_path, $file);
            } else {
                $product['main_image_url'] = 'public/images/default/No_image_available.png';
                $file = @file_get_contents($product['main_image_url']);
                $insert = file_put_contents($img_path, $file);
            }

        } else {
            dd('No such image filter');
        }


        $imageName = strtok(basename($product['main_image_url']), '?');
        $product['v_image_name_local'] = !empty(basename($product['main_image_url'])) ? $imageName : '';
        $product['v_image_path_local'] = !empty($public_path) ? $public_path : '';


        if($page->filter($v07)->count() > 0) {
            $product['text_description'] = $product['text_description'] ?? trim($page->filter($v07)->text());
        } elseif($page->filter($v07)->count() == 0) {
            $product['text_description'] = '';
        }
        

        if($page->filter($v08)->count() > 0) {
            $product['is_promotional'] = $page->filter($v08)->count() ? 1 : 0;
        } elseif($page->filter($v08)->count() == 0) {
            $product['is_promotional'] = 0;
        }
        

        if($page->filter($v09)->count() > 0) {
            $product['old_price'] = $page->filter($v09)->count() ? trim($page->filter($v09)->eq(0)->text()) : null; 
        } elseif($page->filter($v09)->count() == 0) {
            $product['old_price'] = null;
        }
        
        if($page->filter($v10)->count() > 0) {
            $product['new_price'] = $page->filter($v10)->count() ? trim($page->filter($v10)->eq(0)->text()) : null;
        } elseif($page->filter($v10)->count() == 0) {
            $product['new_price'] = '';
        }


        if(is_string($url) && strlen($url) > 0) {
            $product['url'] = $url;
        } elseif(strlen($url) == 0) {
            $product['url'] = '';
        }

        return $product;
        
    }

    /**
     * @param  array $urls
     * @param  string $cattype
     * @param  string $r_command
     * @param  string $site_url
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function saveProducts($urls, $cattype, $r_command, $site_url)
    {
        $i = 0;
        $len = count($urls);

        foreach ($urls as $key => $url) {

            if ($i == 0) {
                $this->saveLogs($url, $len, $r_command);
            } 

            $this::updateOrCreate($this->getProductInfo($url,explode('/',$key)[0], $cattype, $site_url, $r_command));
            $i++;

        }
    }

    /**
     * @param  array $urls
     * @param  string $cattype
     * @param  string $site_url
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function saveProductsForCompare($urls, $cattype, $site_url)
    {
        foreach ($urls as $key => $url) {
            $this::updateOrCreate(['url' => $url], $this->getProductInfoForCompare($url,explode('/',$key)[0], $cattype, $site_url));
        }
    }


}
