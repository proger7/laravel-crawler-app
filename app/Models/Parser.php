<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Symfony\Component\DomCrawler\Crawler;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use GuzzleHttp;

class Parser extends Model
{

    use Cachable;

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
     * @return array $data
     */
    public function curl_get_contents($url)
    {

        $curl_timeout = rand(5, 15);

        $n = "settings.curl_user_agents." . rand(0,4);
        $curl_header = Config::get($n);

        $p = 'settings.curl_proxy_auth.' . rand(0, 49);
        $proxy = Config::get('settings.curl_proxy_ip');
        $proxyauth = Config::get($p);


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $curl_header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
        

        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }


    /**
     * @param  string $url
     * @return array $data
     */
    protected function getCrawler($url)
    {

        $rn = "settings.request_headers." . rand(0,5);
        $headers = Config::get($rn);
        $context = stream_context_create($headers);

        if(Config::get('settings.parsing_mode') == 'file') {
            $html = file_get_contents($url, false, $context);
        } elseif(Config::get('settings.parsing_mode') == 'curl') {
            $html = $this->curl_get_contents($url);
        }

        $crawler = new Crawler($html);
        return $crawler;
    }


    /**
     * @param  string $num
     * @param  string $last
     * @return array $links
     */
    protected function getPageLinks($num, $last)
    {
        $links = [];

        for($i = 1; $i <= $num; $i++) {
            $links[] = str_replace($num, $i, $last);
        }
        
        return $links;
    }


    /**
     * @param  string $url
     * @param   string $filter
     * @return array $links
     */
    protected function getLinks($url, $filter)
    {
        $page = $this->getCrawler($url);
        $links = [];
        $page = $page->filter($filter);
        foreach ($page as $item) {
            $links[trim($item->getAttribute('href'), '/')] = $item->getAttribute('href');
        }
        return $links;
    }


}
