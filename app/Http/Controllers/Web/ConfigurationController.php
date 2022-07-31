<?php

namespace App\Http\Controllers\Web;

use DB;
use App\Models\Configurations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\ConfigurationRequest;
use App\Services\ConfigurationService;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;


class ConfigurationController extends Controller
{

    protected $configuration;
    private $configurationRepository;

    /**
     * Constructor
     * @param Configurations $configuration
     */
    public function __construct(ConfigurationService $configuration, ConfigurationRepositoryInterface $configurationRepository)
    {
        $this->configuration = $configuration;
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * get configurations
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAllConfigurations()
    {

        $confs = $this->configurationRepository->all();
        Redis::set('confs.all', $confs);
        $respConfiguration = response()->json($confs, 200);

        if (Redis::get('confs.all')) 
            return $respConfiguration;

        return $respConfiguration;

    }

    /**
     * 
     * @param  Request $request
     * @return array $customers
     */
    public function index(Request $request)
    {

        $customers = $this->configurationRepository->all();
        Redis::set('confs.index', $customers);
 
        if(Redis::get('confs.index') && $request->has('search')) 
            $customers->paginate(10);

        $customers = Configurations::sortable()->paginate(10);
        $viewIndex = view('configurations.partials.index', compact('customers'));
        $viewAjax = view('configurations.ajax', compact('customers'));
        $view = $request->ajax() ? $viewIndex : $viewAjax;
        return $view;

    }

    /**
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, ConfigurationService $configuration)
    {  
        $items = $this->configurationRepository->getNewest();

        if ($request->isMethod('get'))
            return view('configurations.partials.form' ,compact('items'));
        else {
            return $this->configuration->store($request);
        }
    }

    /**
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->configurationRepository->find($id)->delete($id);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    /**
     * 
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $items = Configurations::item($request->id)->pluck('v_function', 'v_function');

        if ($request->isMethod('get'))
            return view('configurations.partials.form', compact('items'), ['customer' => $this->configurationRepository->find($id)]);
        else {
            return $this->configuration->refresh($request);
        }
    }

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $explode_ids = explode(",", $ids);
        $query = Configurations::elements($explode_ids)->delete();

        $validator = Validator::make($request->all(), [
            'ids' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        if(!$query) {
            return response()->json(['status'=> false]);
        } else {
            return response()->json(['status' => true, 'message'=> __('account.success_configuration')]);
        }  
    }    

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->configuration->getSearch($request);
    }

}