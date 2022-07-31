<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;
use App\Models\Configurations;
use JWTAuth;

class ConfigurationJWTController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return $this->user
            ->configurations()
            ->get(['v_url', 'v_site_url', 'v_content_type', 'v_filter_type', 'v_function'])
            ->toArray();
    }

    public function show($id)
    {
        $configuration = $this->user->configurations()->find($id);

        if (!$configuration) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, configuration with id ' . $id . ' cannot be found'
            ], 400);
        }

        return $configuration;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'v_url' => 'required',
            'v_site_url' => 'required',
            'v_content_type' => 'required',
            'v_filter_type' => 'required',
            'v_function' => 'required'
        ]);

        $configuration = new Configurations();
        $configuration->v_url = $request->v_url;
        $configuration->v_site_url = $request->v_site_url;
        $configuration->v_content_type = $request->v_content_type;
        $configuration->v_filter_type = $request->v_filter_type;
        $configuration->v_function = $request->v_function;

        if ($this->user->configurations()->save($configuration))
            return response()->json([
                'success' => true,
                'configuration' => $configuration
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, configuration could not be added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $configuration = $this->user->configurations()->find($id);

        if (!$configuration) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, configuration with id ' . $id . ' cannot be found'
            ], 400);
        }

        $updated = $configuration->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, configuration could not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $configuration = $this->user->configurations()->find($id);

        if (!$configuration) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, configuration with id ' . $id . ' cannot be found'
            ], 400);
        }

        if ($configuration->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Configuration could not be deleted'
            ], 500);
        }
    }

}
