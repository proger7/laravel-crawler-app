<?php

namespace App\Services;

use DB;
use App\Models\Logs;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigurationRequest;
use Illuminate\Support\Facades\Validator;


class LogService
{

	public function getSearch(Request $request)
	{
        $search = $request->get('search');
        if($search != '') 
        {
            $searchCountLog = DB::table('logs')
                            ->where('v_status', 'like', '%' . $search . '%')
                            ->orWhere('n_parsed_qua', 'like', '%' . $search . '%')
                            ->orWhere('v_url', 'like', '%' . $search . '%')
                            ->orWhere('v_comment', 'like', '%' . $search . '%')
                            ->orWhere('v_command', 'like', '%' . $search . '%')
                            ->orderBy('id', 'desc');
            $customers = DB::table('logs')
                            ->where('v_status', 'like', '%' . $search . '%')
                            ->orWhere('n_parsed_qua', 'like', '%' . $search . '%')
                            ->orWhere('v_url', 'like', '%' . $search . '%')
                            ->orWhere('v_comment', 'like', '%' . $search . '%')
                            ->orWhere('v_command', 'like', '%' . $search . '%')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        } else {
            $searchCountLog = DB::table('logs');
            $customers = DB::table('logs')->paginate(10);
        }
        $total_row = $searchCountLog->count();
        if($total_row >= 0)
        {
            if(!$customers) {
                return response()->json([
                    'success' => false, 
                    'html' => 'No Data found', 
                    'total' => $total_row
                ]);
            }
            $returnHTML = view('logs.partials.search')->with('customers', $customers)->render();
            return response()->json([
                'success' => true, 
                'html'=>$returnHTML, 
                'total' => $total_row
            ]);
        }
	}

    public static function getCategoryLog($filter, $count_categories, $url, $baseURL, $filterName)
    {
        if($filter->exists() && $filter->count() == 1) {
            
            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_categories;
            $logs->v_url = $url;
            $logs->v_site_url = $baseURL;
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url started. Filter $filterName found";
            $logs->v_command =  'sudo php artisan category:save --url=' . $url;
            $logs->save();

        } elseif($filter->exists() && $filter->count() > 1) {

            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_categories;
            $logs->v_url = $url;
            $logs->v_site_url = $baseURL;
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url not started. Excessive filters count $filter->count()";
            $logs->v_command =  'sudo php artisan category:save --url=' . $url;
            $logs->save();

        } elseif(!$filter->exists() || $filter->count() == 0) {
        
            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_categories;
            $logs->v_url = $url;
            $logs->v_site_url = $baseURL;
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url not started. Filter not found in configuration table";
            $logs->v_command =  'sudo php artisan category:save --url=' . $url;
            $logs->save();

        }
    }

    public static function getManufacturerSubcategoriesLog($filter, $count_subcategories, $url, $filterName)
    {
        if($filter->exists() && $filter->count() == 1) {
            
            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_subcategories;
            $logs->v_url = $url;
            $logs->v_site_url = $filter->value('v_site_url');
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url started. Filter $filterName found";
            $logs->v_command =  'sudo php artisan subcategory:save --subcat=' . $url;
            $logs->save();

        } elseif($filter->exists() && $filter->count() > 1) {

            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_subcategories;
            $logs->v_url = $url;
            $logs->v_site_url = $filter->value('v_site_url');
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url not started. Excessive filters count $filter->count()";
            $logs->v_command =  'sudo php artisan subcategory:save --subcat=' . $url;
            $logs->save();

        } elseif(!$filter->exists() || $filter->count() == 0) {
        
            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_subcategories;
            $logs->v_url = $url;
            $logs->v_site_url = $filter->value('v_site_url');
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url not started. Filter not found in configuration table";
            $logs->v_command =  'sudo php artisan subcategory:save --subcat=' . $url;
            $logs->save();

        }
    }

    public static function getManufacturerLog($filter, $count_manufacturers, $url, $filterName)
    {
        if($filter->exists() && $filter->count() == 1) {
            
            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_manufacturers;
            $logs->v_url = $url;
            $logs->v_site_url = $filter->value('v_site_url');
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url started. Filter $filterName found";
            $logs->v_command =  'sudo php artisan hersteller:save --url=' . $url;
            $logs->save();

        } elseif($filter->exists() && $filter->count() > 1) {

            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_manufacturers;
            $logs->v_url = $url;
            $logs->v_site_url = $filter->value('v_site_url');
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url not started. Excessive filters count $filter->count()";
            $logs->v_command =  'sudo php artisan hersteller:save --url=' . $url;
            $logs->save();

        } elseif(!$filter->exists() || $filter->count() == 0) {
        
            $logs = new Logs();
            $logs->v_status = ($filter->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $count_manufacturers;
            $logs->v_url = $url;
            $logs->v_site_url = $filter->value('v_site_url');
            $logs->v_content_type = 'Category 1';
            $logs->v_comment = "Parsing $url not started. Filter not found in configuration table";
            $logs->v_command =  'sudo php artisan hersteller:save --url=' . $url;
            $logs->save();

        }
    }

    public static function saveLogToDatabase(
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
    )   
    {
        if(($filterProductName->exists()) || ($filterProductName->count() == 1) || ($filterCategoryURL->exists()) || ($filterCategoryURL->count() == 1) || ($filterCategoryName->exists()) || ($filterCategoryName->count() == 1) || ($filterProductPrice->exists()) || ($filterProductPrice->count() == 1) || ($filterMainImageURL->exists()) || ($filterMainImageURL->count() == 1) || ($filterProductDescription->exists()) || ($filterProductDescription->count() == 1) || ($filterProductPromotional->exists()) || ($filterProductPromotional->count() == 1) || ($filterOldPrice->exists()) || ($filterOldPrice->count() == 1) || ($filterNewPrice->exists()) || ($filterNewPrice->count() == 1)) {

            $logs = new Logs();
            $logs->v_status = ($filterProductName->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $number;
            $logs->v_url = $baseURL;
            $logs->v_site_url = $baseURL;
            $logs->v_content_type = 'Product 1';
            $logs->v_comment = "Parsing $baseURL started. Filters found";
            $logs->v_command = $r_command;
            $logs->save();

        } elseif(($filterProductName->exists()) || ($filterProductName->count() > 1) || ($filterCategoryURL->exists()) || ($filterCategoryURL->count() > 1) || ($filterCategoryName->exists()) || ($filterCategoryName->count() > 1) || ($filterProductPrice->exists()) || ($filterProductPrice->count() > 1) || ($filterMainImageURL->exists()) || ($filterMainImageURL->count() > 1) || ($filterProductDescription->exists()) || ($filterProductDescription->count() > 1) || ($filterProductPromotional->exists()) || ($filterProductPromotional->count() > 1) || ($filterOldPrice->exists()) || ($filterOldPrice->count() > 1) || ($filterNewPrice->exists()) || ($filterNewPrice->count() > 1)) {

            $logs = new Logs();
            $logs->v_status = ($filterProductName->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $number;
            $logs->v_url = $baseURL;
            $logs->v_site_url = $baseURL;
            $logs->v_content_type = 'Product 1';
            $logs->v_comment = "Parsing $baseURL not started.";
            $logs->v_command =  $r_command;
            $logs->save();

        } elseif((!$filterProductName->exists()) || ($filterProductName->count() == 0) || (!$filterCategoryURL->exists()) || ($filterCategoryURL->count() == 0) || (!$filterCategoryName->exists()) || ($filterCategoryName->count() == 0) || (!$filterProductPrice->exists()) || ($filterProductPrice->count() == 0) || (!$filterMainImageURL->exists()) || ($filterMainImageURL->count() == 0) || (!$filterProductDescription->exists()) || ($filterProductDescription->count() == 0) || (!$filterProductPromotional->exists()) || ($filterProductPromotional->count() == 0) || (!$filterOldPrice->exists()) || ($filterOldPrice->count() == 0) || (!$filterNewPrice->exists()) || ($filterNewPrice->count() == 0)) {
        
            $logs = new Logs();
            $logs->v_status = ($filterProductName->exists() === true) ? 'Success' : 'Error';
            $logs->n_parsed_qua = $number;
            $logs->v_url = $baseURL;
            $logs->v_site_url = $baseURL;
            $logs->v_content_type = 'Product 1';
            $logs->v_comment = "Parsing $baseURL not started. Filters not found in configuration table";
            $logs->v_command =  $r_command;
            $logs->save();

        }  
    }

}