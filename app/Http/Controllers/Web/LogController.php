<?php
namespace App\Http\Controllers\Web;

use DB;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Services\LogService;
use App\Repositories\Interfaces\LogRepositoryInterface;


class LogController extends Controller
{

    protected $logs;
    private $logRepository;

    /**
     * Constructor
     * @param Logs $logs
     */
    public function __construct(LogService $logs, LogRepositoryInterface $logRepository)
    {
        $this->logs = $logs;
        $this->logRepository = $logRepository;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllLogs()
    {

        $logs = $this->logRepository->all();
        Redis::set('logs.all', $logs);
        $respLog = response()->json($logs, 200);

        if (Redis::get('logs.all'))
            return $respLog;

        return $respLog;

    }

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $customers = $this->logRepository->all();
        Redis::set('logs.partials.index', $customers);

        if(Redis::get('logs.partials.index') && $request->has('search')) 
            $customers->paginate(10);

        $customers = Logs::sortable()->paginate(10);
        $viewIndex = view('logs.partials.index', compact('customers'));
        $viewAjax = view('logs.ajax', compact('customers'));
        $view = $request->ajax() ? $viewIndex : $viewAjax;

        return $view;

    }

    /**
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->logRepository->find($id)->delete($id);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
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
        $query = Logs::elements($explode_ids)->delete();

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
            return response()->json(['status' => true, 'message' => __('account.success_log')]);
        }

    }

    /**
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->logs->getSearch($request);
    }

}