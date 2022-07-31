<?php

namespace App\Http\Middleware;

use Closure;
use Auth0\SDK\JWTVerifier;  
use Auth0\SDK\Helpers\Cache\FileSystemCacheHandler; 

class CheckAccess
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
        if (!empty(env('AUTH0_AUDIENCE')) && !empty(env('AUTH0_DOMAIN'))) {
            $verifier = new JWTVerifier([
                'valid_audiences' => [env('AUTH0_AUDIENCE')],
                'authorized_iss' => [env('AUTH0_DOMAIN')],
                'supported_algs' => ['RS256']
            ]);
            $token = $request->bearerToken();
            $decodedToken = $verifier->verifyAndDecode($token);
            if (!$decodedToken) {
                abort(403, 'Access denied');
            }
        }
        return $next($request);
    }
}
