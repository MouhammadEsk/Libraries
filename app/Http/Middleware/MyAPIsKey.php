<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController ;

class MyAPIsKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if($request->header('authorization')==='Bearer 2|UaAwW0yWxmPwPNIOWSo0DPppi9PZaCaJavBuNRSu'){

            return $next($request);

        }
        return BaseController::sendError([],'can not find APIs Key',401);


    }
}
