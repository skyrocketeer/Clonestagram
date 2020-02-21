<?php

namespace App\Http\Middleware\Api;

use Closure;
use Auth;

class Authenticate
{
    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return $response 
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check()){
            return $next($request);
        }
        
        return response()->json(['errorMessage'=> 'unauthenticate'], 403);   
    }

    
}
