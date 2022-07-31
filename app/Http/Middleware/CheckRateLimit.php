<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class CheckRateLimit
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = 1;

        if (Redis::command('hincrby', ['RateLimits', "User:{$id}:limit", -1]) >= 0) {
            return $next($request);
        } else {
            return response()->json(['status' => 0, 'message' => 'You already reached your requests limit.']);
        }
    }

}
