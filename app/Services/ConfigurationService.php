<?php

namespace App\Services;

use DB;
use App\Models\Configurations;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigurationRequest;
use Illuminate\Support\Facades\Validator;

class ConfigurationService
{

	public function store(Request $request)
	{
        $rules = ConfigurationRequest::rules();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $customer = new Configurations;
        $customer->v_function = $request->filterfunction;
        $customer->v_site_url = $request->siteurl;
        $customer->v_content_type = $request->contenttype;
        $customer->v_filter_type = $request->filtertype;
        $customer->v_url = $request->itemUrl;
        $customer->save();

        return response()->json([
            'fail' => false,
            'redirect_url' => url('configurations')
        ]);
	}

	public function refresh(Request $request)
	{
        $rules = ConfigurationRequest::rules();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $customer = Configurations::find($id);
        $customer->v_function = $request->filterfunction;
        $customer->v_site_url = $request->siteurl;
        $customer->v_content_type = $request->contenttype;
        $customer->v_filter_type = $request->filtertype;
        $customer->v_url = $request->itemUrl;
        $customer->save();
        
        return response()->json([
            'fail' => false,
            'redirect_url' => url('configurations')
        ]);
	}

	public function getSearch(Request $request)
	{
        $search = $request->get('search');
        
        if($search != '') 
        {
            $searchCount = DB::table('configurations')
                            ->where('v_function', 'like', '%' . $search . '%')
                            ->orWhere('v_url', 'like', '%' . $search . '%')
                            ->orWhere('v_content_type', 'like', '%' . $search . '%')
                            ->orderBy('id', 'desc');
            $customers = DB::table('configurations')
			                ->where('v_function', 'like', '%' . $search . '%')
			                ->orWhere('v_url', 'like', '%' . $search . '%')
			                ->orWhere('v_content_type', 'like', '%' . $search . '%')
			                ->orderBy('id', 'desc')
			                ->paginate(10);
        } else {
        	$searchCount = DB::table('configurations');
            $customers = DB::table('configurations')->paginate(10);
        }

        $total_row = $searchCount->count();
        if($total_row >= 0)
        {
            if(!$customers) {
                return response()->json([
                    'success' => false, 
                    'html'=>'No Data found', 
                    'total' => $total_row
                ]);
            }
            $returnHTML = view('configurations.partials.search')->with('customers', $customers)->render();
            return response()->json([
                'success' => true, 
                'html' => $returnHTML, 
                'total' => $total_row
            ]);
        }
	}

}