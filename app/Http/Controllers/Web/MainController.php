<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use Cache;
use Illuminate\Support\Facades\Redis;
use Queue;
use Config;

class MainController extends Controller
{

	/**
	 *
	 * @return Response
	 */
    public function home()
    {
    	$visits = Redis::incr('visits');
        return view('welcome', compact('visits'));
    }

}