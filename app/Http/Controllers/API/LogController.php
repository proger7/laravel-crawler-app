<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Logs;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\API\LogRequest as LogApiRequest;


class LogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $logs = Cache::remember('logs', 22*60, function() {
            return Logs::all();
        });
        return $this->sendResponse($logs->toArray(), __('account.logs_api'));
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
        $rules = LogApiRequest::rules();
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return $this->sendError(__('account.validate_error'), $validator->errors());       
        }

        $log = Logs::create($input);
        return $this->sendResponse($log->toArray(), __('account.logs_create_api'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $log = Logs::find($id);

        if (is_null($log)) {
            return $this->sendError(__('account.no_log'));
        }

        return $this->sendResponse($log->toArray(), __('account.logs_show_api'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Logs $log)
    {
        $input = $request->all();
        $rules = LogApiRequest::rules();
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return $this->sendError(__('account.validate_error'), $validator->errors());       
        }

        $log->v_status = $input['v_status'];
        $log->n_parsed_qua = $input['n_parsed_qua'];
        $log->v_url = $input['v_url'];
        $log->v_site_url = $input['v_site_url'];
        $log->v_content_type = $input['v_content_type'];
        $log->v_comment = $input['v_comment'];
        $log->v_command = $input['v_command'];
        $log->save();

        return $this->sendResponse($log->toArray(), __('account.logs_update_api'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Logs $log)
    {
        $log->delete();
        return $this->sendResponse($log->toArray(), __('account.logs_delete_api'));
    }

}