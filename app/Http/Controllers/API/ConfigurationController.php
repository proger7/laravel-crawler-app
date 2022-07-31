<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Configurations;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\API\ConfigurationRequest as ConfApiRequest;


class ConfigurationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $configurations = Cache::remember('configurations', 22*60, function() {
            return Configurations::all();
        });
        return $this->sendResponse($configurations->toArray(), __('account.success_configuration_api'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $rules = ConfApiRequest::rules();
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return $this->sendError(__('account.validate_error'), $validator->errors());       
        }

        $configuration = Configurations::create($input);
        return $this->sendResponse($configuration->toArray(), __('account.configuration_create_api'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $configuration = Configurations::find($id);

        if (is_null($configuration)) {
            return $this->sendError(__('account.no_configuration'));
        }

        return $this->sendResponse($configuration->toArray(), __('account.configuration_show_api'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Configurations $configuration)
    {
        $input = $request->all();
        $rules = ConfApiRequest::rules();
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return $this->sendError(__('account.validate_error'), $validator->errors());       
        }

        $configuration->v_url = $input['v_url'];
        $configuration->v_site_url = $input['v_site_url'];
        $configuration->v_content_type = $input['v_content_type'];
        $configuration->v_filter_type = $input['v_filter_type'];
        $configuration->v_function = $input['v_function'];
        $configuration->save();

        return $this->sendResponse($configuration->toArray(), __('account.configuration_update_api'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Configurations $configuration)
    {
        $configuration->delete();
        return $this->sendResponse($configuration->toArray(), __('account.configuration_delete_api'));
    }

}