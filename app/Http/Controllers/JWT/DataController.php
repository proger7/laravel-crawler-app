<?php

namespace App\Http\Controllers\JWT;

use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;

class DataController extends Controller
{
	/**
	 * Open data
	 * @return \Illuminate\Http\Response
	 */
	public function open() 
	{
		$data = "This data is open and can be accessed without the client being authenticated";
		return response()->json(compact('data'), 200);
	}

	/**
	 * Closed data
	 * @return \Illuminate\Http\Response
	 */
	public function closed() 
	{
		$data = "Only authorized users can see this";
		return response()->json(compact('data'), 200);
	}

}
