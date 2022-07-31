<?php

namespace App\Http\Controllers\Web;

use Schema;
use SplTempFileObject;
use App\Models\Parser;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use League\Csv\Writer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class ParseController extends Controller
{
    /**
     * @param array $columnNames
     * @param array $rows
     * @param string $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public static function getCsv($columnNames, $rows, $fileName) {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $fileName,
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        $callback = function() use ($columnNames, $rows ) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columnNames);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * 
     * @return Response
     */
    public function index()
    {
        return view('parse.index');
    }

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function parseCategory(Request $request)
    {

        $url = $request->get('category_url');

        if(isset($url) && $request->isMethod('post') || $request->ajax()) {

            $validator = Validator::make($request->all(), [
                'category_url' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ], [
                'category_url.required' => __('account.success_category_url'),
                'g-recaptcha-response'=> __('account.success_recaptcha')
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 400);
            }

            $items = Category::all();
            $categories = Category::getInstance()->getCategories($url);
            Category::getInstance()->saveCategories($categories); 

            if(!$categories) {
                return response()->json([
                    'success' => false, 
                    'html' => __('account.no_categories')
                ]);
            }

            $returnHTML = view('parse.data.table')->with('categories', $categories)->render();
            return response()->json([
                'success' => true, 
                'html' => $returnHTML
            ]);


        }

        return view('parse.type.form');
    }

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCategoryCSV(Request $request)
    {
        $url = Category::orderBy('id', 'desc')->first()->v_site_url;
        $categories = Category::getInstance()->getCategories($url);
        $rows = $categories;
        $columnNames = ['Category type', 'Site URL', 'Name','Link', 'Alias'];       
        return self::getCsv($columnNames, $rows, 'categories.csv');
    }  

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function parseManufacturer(Request $request)
    {
        $url = $request->get('manufacturer_url');

        if(isset($url) && $request->isMethod('post') || $request->ajax()) {

            $validator = Validator::make($request->all(), [
                'manufacturer_url' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ], [
                'manufacturer_url.required' => __('account.success_manufacturer_url'),
                'g-recaptcha-response'=> __('account.success_recaptcha')
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 400);
            }

            $items = Manufacturer::all();
            $manufacturers = Manufacturer::getInstance()->getManufacturers($url);
            Manufacturer::getInstance()->saveManufacturers($manufacturers);


            if(!$manufacturers) {
                return response()->json([
                    'success' => false, 
                    'html' => __('account.no_manufacturer')
                ]);
            }

            $returnHTML = view('parse.data.table')->with('manufacturers', $manufacturers)->render();
            return response()->json([
                'success' => true, 
                'html' => $returnHTML
            ]);

        }

    	return view('parse.type.form');
    }

    /**
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function getManufacturerCSV(Request $request)
    {
        switch($request->submitbutton) {
            case 'download': 
                $url = Manufacturer::orderBy('id', 'desc')->first()->v_site_url;
                $manufacturers = Manufacturer::getInstance()->getManufacturers($url);
                $rows = $manufacturers;
                $columnNames = ['Category type', 'Site URL', 'Name', 'Alias', 'Link'];       
                return self::getCsv($columnNames, $rows, 'manufacturers.csv');
            break;

            case 'clear': 
                return redirect('/parse/manufacturer');
            break;
        } 
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function parseProduct(Request $request)
    {
        $from = $request->get('product_from');
        $count = $request->get('product_count');
        $cat = $request->get('product_url');
        $cattype = $request->get('category_type');
        $r_command = 'php artisan parser:start ' . $from . ' ' . $count . ' --url=' . $cat . ' --cattype=' . $cattype;

        if(isset($from) && isset($count) && isset($cat) && isset($cattype) && $request->isMethod('post') || $request->ajax()) {

            $validator = Validator::make($request->all(), [
                'product_from' => 'required',
                'product_count' => 'required',
                'product_url' => 'required',
                'category_type' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ], [
                'product_from.required' => __('account.product_from_validate'),
                'product_count.required' => __('account.product_count_validate'),
                'product_url.required' => __('account.product_url_validate'),
                'category_type.required' => __('account.category_type_validate'),
                'g-recaptcha-response'=> __('account.success_recaptcha')
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 400);
            }

            $product_list = Product::getInstance()->getProductUrl($from, $count, $cat);
            Product::getInstance()->saveProducts($product_list, $cattype, $r_command, $cat);

            $a = [];
            foreach ($product_list as $key => $url) {
                $a[] = Product::getInstance()->getProductInfo($url, '', $cattype, $cat, $r_command);
            }

            if(!$a) {
                return response()->json([
                    'success' => false, 
                    'html' => __('account.no_product')
                ]);
            }

            $returnHTML = view('parse.data.table')->with('a', $a)->render();
            return response()->json([
                'success' => true, 
                'html'=>$returnHTML
            ]);  

        }

    	return view('parse.type.form');
    }

    /**
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function getProductCSV(Request $request)
    {
        switch($request->submitbutton) {
            case 'download': 
                $url = Product::orderBy('id', 'desc')->first()->site_url;
                $from = 0;
                $count = Logs::orderBy('id', 'desc')->first()->n_parsed_qua;
                $cat = Product::orderBy('id', 'desc')->first()->category_url;
                $cattype = Product::orderBy('id', 'desc')->first()->category_type;
                $r_command = Product::orderBy('id', 'desc')->first()->v_command;
                $product_list = Product::getInstance()->getProductUrl($from, $count, $cat);

                $a = [];
                foreach ($product_list as $key => $url) {
                $a[] = Product::getInstance()->getProductInfo($url, '', $cattype, $cat, $r_command);
                }

                $rows = $a;
                $columnNames = ['Category URL', 'Category type', 'Produwct name', 'Product URL', 'Category Alias', 'Category Name', 'Price', 'Main image URL', 'Image size', 'Image name', 'Image path', 'Description', 'Is Promotional', 'Old price', 'New price', 'Additional content', 'Product configure', 'URL'];

                return self::getCsv($columnNames, $rows, 'products.csv');
            break;

            case 'clear': 
                return redirect('/parse/product');
            break;
        }    
    }


    /**
     *
     * @param  Request $request
     * @return Response      
     */
    public function parseSubcategory(Request $request)
    {
        $subcat = $request->get('subcategory_url');

        if(isset($subcat) && $request->isMethod('post') || $request->ajax()) {

            $validator = Validator::make($request->all(), [
                'subcategory_url' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ], [
                'subcategory_url.required' => __('account.subcategory_url_validate'),
                'g-recaptcha-response'=> __('account.success_recaptcha')
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 400);
            }

            $subcategory_list = Manufacturer::getInstance()->getSubcategories($subcat);
            Manufacturer::getInstance()->saveManufacturers($subcategory_list);

            if(!$subcategory_list) {
                return response()->json([
                    'success' => false, 
                    'html' => __('account.no_subcategory')
                ]);
            }

            $returnHTML = view('parse.data.table')->with('subcategory_list', $subcategory_list)->render();
            return response()->json([
                'success' => true, 
                'html' => $returnHTML
            ]);

        }

    	return view('parse.type.form');
    }

    /**
     *
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function getSubcategoryCSV(Request $request)
    {
        switch($request->submitbutton) {
            case 'download': 
                $url = Manufacturer::orderBy('id', 'desc')->first()->v_site_url;
                $subcategory_list = Manufacturer::getInstance()->getSubcategories($url);
                $rows = $subcategory_list;
                $columnNames = ['Category type', 'Site URL', 'Name', 'Alias', 'Link'];       
                return self::getCsv($columnNames, $rows, 'subcategories.csv'); 
            break;

            case 'clear': 
                return redirect('/parse/subcategory');
            break;
        }        
    }

}
